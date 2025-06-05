<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleInformation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'amb_per_dist_fees',
        'plate_number',
        'color',
        'model',
        'seat',
        'vehicle_type_id',
        'driver_id'
    ];

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class);
    }
}
