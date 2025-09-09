<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = ['vehicle_id', 'seat_number'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
