<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seats = [
            ['bus_id' => 1, 'SeatNumber' => 1, 'IsAvailable' => false],
            ['bus_id' => 1, 'SeatNumber' => 2, 'IsAvailable' => true],
            ['bus_id' => 1, 'SeatNumber' => 3, 'IsAvailable' => true],
            ['bus_id' => 1, 'SeatNumber' => 4, 'IsAvailable' => true],
            ['bus_id' => 1, 'SeatNumber' => 5, 'IsAvailable' => true],
            ['bus_id' => 1, 'SeatNumber' => 6, 'IsAvailable' => true],
            ['bus_id' => 1, 'SeatNumber' => 7, 'IsAvailable' => true],
            ['bus_id' => 1, 'SeatNumber' => 8, 'IsAvailable' => true],
            ['bus_id' => 1, 'SeatNumber' => 9, 'IsAvailable' => true],
            ['bus_id' => 1, 'SeatNumber' => 10, 'IsAvailable' => true],
            ['bus_id' => 1, 'SeatNumber' => 11, 'IsAvailable' => true],
            ['bus_id' => 1, 'SeatNumber' => 12, 'IsAvailable' => true],
        ];

        foreach ($seats as $seatData) {
            Seat::create($seatData);
        }
    }
}
