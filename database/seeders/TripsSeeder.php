<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trip;

class TripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trips = [
            ['StartLocation' => 'Cairo', 'EndLocation' => 'Asyut', 'bus_id' => 1],
            ['StartLocation' => 'Alexanderia', 'EndLocation' => 'Aswan', 'bus_id' => 2],
            // Add more records as needed
        ];

        foreach ($trips as $tripData) {
            Trip::create($tripData);
        }
    }
}
