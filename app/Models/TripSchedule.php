<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripSchedule extends Model
{
    protected $fillable = ['route_id', 'vehicle_id', 'trip_date', 'departure_time'];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
