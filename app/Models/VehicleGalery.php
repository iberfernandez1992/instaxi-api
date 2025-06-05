<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleGalery extends Model
{
    protected $fillable = [
        'soat_photo',
        'ci_photo',
        'address_voucher_photo',
        'matricula_photo',
        'driver_license_photo',
        'driver_id',
        'id_vehicle',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(VehicleInformation::class, 'id_vehicle');
    }

      // ✅ Accessors para devolver la URL completa de cada imagen
    public function getSoatPhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;

    }

    public function getCiPhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function getAddressVoucherPhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function getMatriculaPhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function getDriverLicensePhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
}
