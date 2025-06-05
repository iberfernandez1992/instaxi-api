<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'type', 'service_id', 'description',
        'service_category_image_id', 'status', 'created_by_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
  public function getServiceCategoryImageIdAttribute($value)
    {
    return $value ? asset('storage/' . $value) : null;
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}