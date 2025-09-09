<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $fillable = [
        'name', // Add more fields if needed
    ];

    /**
     * The vehicles that have this amenity.
     */
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'amenity_vehicle');
    }
}
