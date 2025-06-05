<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'service_id',
        'service_category_id',
        'vehicle_image',
        'vehicle_map_icon',
        'slug',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }
       // ✅ Sobrescribir los valores directamente para devolver la URL
    public function getVehicleImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function getVehicleMapIconAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
}
