<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_seat', 'seat_id', 'reservation_id')
            ->withPivot('from_station_id', 'to_station_id');
    }
}
