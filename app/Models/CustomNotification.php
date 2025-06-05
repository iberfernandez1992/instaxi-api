<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomNotification extends Model
{
    use HasFactory;

    
    protected $table = 'notifications'; 

    
    protected $fillable = [
        'user_id',
        'type',
        'data',
        'name',
    ];

    /**
     * Relación: una notificación pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
