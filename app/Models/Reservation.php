<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function fromStation()
    {
        return $this->belongsTo(Station::class, 'FromStationID');
    }

    public function toStation()
    {
        return $this->belongsTo(Station::class, 'ToStationID');
    }
    public function seats()
    {
        return $this->belongsToMany(Seat::class, 'reservation_seat', 'reservation_id', 'seat_id')
            ->withPivot('from_station_id', 'to_station_id');
    }
}
