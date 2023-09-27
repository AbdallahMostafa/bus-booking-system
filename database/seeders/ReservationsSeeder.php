<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = [
            [
                'trip_id' => 1,
                'user_id' => 1,
                'ReservationDate' => now(),
                'from_station_id' => 1,
                'to_station_id' => 3,
                'seat_id' => 1
            ],
            [
                'trip_id' => 1,
                'user_id' => 2,
                'ReservationDate' => now(),
                'from_station_id' => 1,
                'to_station_id' => 2,
                'seat_id' => 2

            ],
            [
                'trip_id' => 1,
                'user_id' => 3,
                'ReservationDate' => now(),
                'from_station_id' => 1,
                'to_station_id' => 2,
                'seat_id' => 3

            ],
            [
                'trip_id' => 1,
                'user_id' => 4,
                'ReservationDate' => now(),
                'from_station_id' => 1,
                'to_station_id' => 2,
                'seat_id' => 4

            ],
            [
                'trip_id' => 1,
                'user_id' => 5,
                'ReservationDate' => now(),
                'from_station_id' => 1,
                'to_station_id' => 2,
                'seat_id' => 5

            ],
            [
                'trip_id' => 1,
                'user_id' => 6,
                'ReservationDate' => now(),
                'from_station_id' => 1,
                'to_station_id' => 2,
                'seat_id' => 6

            ],
            [
                'trip_id' => 1,
                'user_id' => 7,
                'ReservationDate' => now(),
                'from_station_id' => 1,
                'to_station_id' => 2,
                'seat_id' => 7

            ],
            [
                'trip_id' => 1,
                'user_id' => 8,
                'ReservationDate' => now(),
                'from_station_id' => 1,
                'to_station_id' => 2,
                'seat_id' => 8

            ],
            [
                'trip_id' => 1,
                'user_id' => 9,
                'ReservationDate' => now(),
                'from_station_id' => 1,
                'to_station_id' => 2,
                'seat_id' => 9

            ],
            [
                'trip_id' => 1,
                'user_id' => 10,
                'ReservationDate' => now(),
                'from_station_id' => 1,
                'to_station_id' => 2,
                'seat_id' => 10

            ],
            [
                'trip_id' => 1,
                'user_id' => 11,
                'ReservationDate' => now(),
                'from_station_id' => 1,
                'to_station_id' => 3,
                'seat_id' => 11

            ],
            [
                'trip_id' => 1,
                'user_id' => 12,
                'ReservationDate' => now(),
                'from_station_id' => 1,
                'to_station_id' => 2,
                'seat_id' => 12

            ],
        ];

        foreach ($reservations as $reservationData) {
            Reservation::create($reservationData);
        }
    }
}
