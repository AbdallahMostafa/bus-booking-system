<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Station;

class StationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stations = [
            ['Name' => 'Cairo', 'order_in_trip' => 1, 'trip_id' => 1],
            ['Name' => 'AlFayoum', 'order_in_trip' => 2, 'trip_id' => 1],
            ['Name' => 'Alminya', 'order_in_trip' => 3, 'trip_id' => 1],
            ['Name' => 'Asyut', 'order_in_trip' => 4, 'trip_id' => 1],
        ];

        foreach ($stations as $stationData) {
            Station::create($stationData);
        }
    }
}
