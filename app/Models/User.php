<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'country_code',
        'phone',
        'password',
        'profile_image_id',
        'is_verified',
        'status',
        'referral_code',
        'fcm_token',
        'is_online',
        'is_on_ride',
        'location',
        'service_id',
        'service_category_id',
        'role',
        'lat',
        'lng'
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_verified' => 'boolean',
        'is_online' => 'boolean',
        'is_on_ride' => 'boolean',
        'location' => 'array', // Si guardas JSON aquí
        'password' => 'hashed',
        'role' => 'string',
    ];

    public function rideRequestNotifications()
{
    return $this->hasMany(RideRequestNotification::class, 'driver_id');
}
}
