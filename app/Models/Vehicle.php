<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'name',
        'plate_number',
        'total_seats',
        'vehicle_type_id',
        'image'
    ];

    public function type()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
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
