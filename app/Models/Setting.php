<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
protected $fillable = ['values']; // <-- agrega esta línea

    protected $casts = [
        'values' => 'array', // para que Laravel lo trate como array automáticamente
    ];
}