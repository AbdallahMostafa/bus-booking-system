<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Trip;
use Illuminate\Support\Facades\Log;
use App\Models\Reservation;
use App\Models\Station;
use Illuminate\Support\Facades\Auth;
use App\Services\CreateReservationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class SeatController extends Controller
{
    protected $createReservationService;
    public function __construct(CreateReservationService $createReservationService)
    {
        $this->createReservationService = $createReservationService;
    }
    /**
     * Retrieve information about available seats for booking on a specific trip between two stations.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing station information.
     *
     * @return \Illuminate\Http\JsonResponse JSON response containing available seat information.
     */

    public function availableSeats(Request $request) : JsonResponse
    {
        $startStationName = $request->input('departure_location_id');
        $endStationName = $request->input('arrival_location_id');
        
        $trip=  Trip::select('trips.id', 'trips.bus_id as bus_id')
            ->join('stations as sa', 'trips.id', '=', 'sa.trip_id')
            ->join('stations as sd', 'trips.id', '=', 'sd.trip_id')
            ->where('sa.Name', $startStationName)
            ->where('sd.Name', $endStationName)
            ->whereColumn('sa.order_in_trip', '<', 'sd.order_in_trip')
            ->first();
        
        $allSeats = Seat::where('bus_id', $trip->bus_id)->get();
        $reservations = Reservation::where('trip_id', $trip->id)->get();
        $reservedSeatIds = $reservations->pluck('seat_id')->toArray();
        $availableSeats = $allSeats->whereNotIn('id', $reservedSeatIds)->pluck('SeatNumber');

        
        $totalAvailableSeats = count($availableSeats);

        if($totalAvailableSeats > 0) {    
            return response()->json(
                [
                'avaliable seats' => $availableSeats
                ]
            );
        }
        else {
            $station = Station::where('Name', $startStationName)->first();

            $reservations = Reservation::join('stations', 'reservations.to_station_id', '=', 'stations.id')
                ->where('reservations.trip_id', $trip->id)
                ->where(
                    function ($query) use ($station) {
                        $query->where('stations.id', $station->id)
                            ->orWhere('stations.order_in_trip', '<', $station->order_in_trip);
                    }
                )->get();
            return response()->json(
                [
                'avaliable seats' => $reservations
                ]
            );
        }
    }

    /**
     * Book a seat for a user on a specific trip.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing booking data.
     *
     * @return \Illuminate\Http\JsonResponse JSON response indicating the booking status.
     *
     * @throws \Exception When an error occurs during the booking process.
     */
    public function bookSeat(Request $request): JsonResponse
    {
        $user = Auth::user();
        $startStationName = $request->input('departure_location_id');
        $endStationName = $request->input('arrival_location_id');
        $seat_id = $request->input('seat_id');
        
        DB::beginTransaction();
        try {
            $trip =  Trip::select('trips.id')
                ->join('stations as sa', 'trips.id', '=', 'sa.trip_id')
                ->join('stations as sd', 'trips.id', '=', 'sd.trip_id')
                ->where('sa.Name', $startStationName)
                ->where('sd.Name', $endStationName)
                ->whereColumn('sa.order_in_trip', '<', 'sd.order_in_trip')
                ->first();

            $userSeat = Seat::where('SeatNumber', $seat_id)->lockForUpdate()->first();

            if($userSeat->IsAvailable) {
                $reservation =  $this->createReservationService->createReservation($startStationName, $endStationName, $userSeat, $user, $trip);
                $userSeat->IsAvailable = false;
                $userSeat->save();
                DB::commit();

                return response()->json(
                    [
                    'Booked Successfully' => $reservation
                    ]
                );
            } else {
                $station = Station::where('Name', $startStationName)->first();
                $reservations = Reservation::join('stations', 'reservations.to_station_id', '=', 'stations.id')
                    ->where('reservations.trip_id', $trip->id)
                    ->where('reservations.seat_id', $seat_id)
                    ->where(
                        function ($query) use ($station) {
                            $query->where('stations.id', $station->id)
                                ->orWhere('stations.order_in_trip', '<', $station->order_in_trip);
                        }
                    )->get();
                if(empty($reservations) || count($reservations) == 0) {
                    // Rollback the transaction if the seat is not available
                    DB::rollback();
                        
                    return response()->json(
                        [
                        'message' => 'Seat is already booked or unavailable'
                        ]
                    );
                }
                $reservation =  $this->createReservationService->createReservation($startStationName, $endStationName, $userSeat, $user, $trip);
                DB::commit();

                $reservation->save();
                return response()->json(
                    [
                    'Booked Successfully' => $reservation
                    ]
                );
            } 
            
        } catch (\Exception $e) {
            // Handle exceptions and roll back the transaction in case of errors
            DB::rollback();
            return response()->json(
                [
                'message' => 'An error occurred while booking the seat'
                ]
            );

        }
        
    }
    
}
