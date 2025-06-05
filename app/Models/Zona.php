<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zona extends Model
{
    use SoftDeletes;

    protected $table = 'zonas';

    protected $fillable = [
        'name',
        'place_points',
        'locations',
        'amount',
        'status',
        'distance_type',
    ];

    protected $casts = [
        'place_points' => 'array',
        'locations' => 'array',
        'amount' => 'decimal:2',
    ];
}
