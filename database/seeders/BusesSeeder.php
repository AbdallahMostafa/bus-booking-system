<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bus;
use Illuminate\Support\Facades\DB;

class BusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buses')->insert([
            ['BusNumber' => 'Bus001', 'TotalSeats' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['BusNumber' => 'Bus002', 'TotalSeats' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['BusNumber' => 'Bus003', 'TotalSeats' => 12, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
