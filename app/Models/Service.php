<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'service_image',
        'service_icon',
        'type',
        'status',
        'is_primary',
        'created_by_id',
    ];

    // Relación opcional con el usuario que creó el servicio
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    // Si tienes una tabla de media (imágenes o íconos)
      public function getServiceImageAttribute($value)
    {
    return $value ? asset('storage/' . $value) : null;
    }
public function service()
{
    return $this->belongsTo(Service::class);
}
    public function getServiceIconAttribute($value)
    {
    return $value ? asset('storage/' . $value) : null;
    }
    // Scope para obtener solo activos
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Scope para servicios principales
    public function scopePrimary($query)
    {
        return $query->where('is_primary', 1);
    }
}
