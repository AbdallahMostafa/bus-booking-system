<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(15)->create();
        $this->call(BusesSeeder::class);
        $this->call(SeatsSeeder::class);
        $this->call(TripsSeeder::class);
        $this->call(StationsSeeder::class);
        $this->call(ReservationsSeeder::class);
        
    }
}
