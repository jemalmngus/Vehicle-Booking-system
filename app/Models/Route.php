<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['start_station_id', 'end_station_id', 'distance_km'];

    public function startStation()
    {
        return $this->belongsTo(Station::class, 'start_station_id');
    }

    public function endStation()
    {
        return $this->belongsTo(Station::class, 'end_station_id');
    }


    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function schedules()
    {
        return $this->hasMany(TripSchedule::class);
    }
}
