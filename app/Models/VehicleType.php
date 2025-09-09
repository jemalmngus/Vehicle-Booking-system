<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    protected $fillable = ['name', 'price_per_km'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
