<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $fillable = ['name', 'address', 'latitude', 'longitude'];

    public function routesAsStart()
    {
        return $this->hasMany(Route::class, 'start_station_id');
    }

    public function routesAsEnd()
    {
        return $this->hasMany(Route::class, 'end_station_id');
    }
}
