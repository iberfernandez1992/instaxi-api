<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectionRider extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','direccion', 'lat', 'lng', 'id_rider'];

    public function rider()
    {
        return $this->belongsTo(User::class, 'id_rider');
    }
}