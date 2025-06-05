<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RideRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'rider_id',
        'service_id',
        'vehicle_type_id',
        'service_category_id',
        'locations',
        'location_coordinates',
        'duration',
        'distance',
        'distance_unit',
        'ride_fare',
        'description',
        'start_time',
        'end_time',
        'status', // ✅ nuevo campo incluido
        'created_by_id',
    ];

    protected $casts = [
        'locations' => 'array',
        'location_coordinates' => 'array',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function notifications()
{
    return $this->hasMany(RideRequestNotification::class);
}
}
