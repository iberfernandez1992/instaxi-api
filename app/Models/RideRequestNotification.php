<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RideRequestNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_request_id',
        'driver_id',
        'status',
        'notified_at',
        'responded_at',
        'response_time_sec',
        'device_type',
        'fcm_token_snapshot',
    ];

    protected $casts = [
        'notified_at' => 'datetime',
        'responded_at' => 'datetime',
    ];

    public function rideRequest()
    {
        return $this->belongsTo(RideRequest::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}