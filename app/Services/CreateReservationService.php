<?php

namespace App\Services;
use App\Models\Station;
use App\Models\Reservation;

class CreateReservationService
{
    public function createReservation($startStationName, $endStationName,$userSeat, $user, $trip)
    {
        $from_station_id = Station::where('Name', $startStationName)->first();
        $to_station_id = Station::where('Name', $endStationName)->first();
        $reservation = new Reservation();
        $reservation->user_id = $user->id;
        $reservation->trip_id = $trip->id;
        $reservation->from_station_id = $from_station_id->id;
        $reservation->to_station_id = $to_station_id->id;
        $reservation->seat_id = $userSeat->id;
        $reservation->ReservationDate = now();
        $reservation->save();
        return $reservation;
    }
}
