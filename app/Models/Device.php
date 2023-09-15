<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Device extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'serial_number', 'type_device_id', 'brand_id', 'model_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function typeDevice()
    {
        return $this->belongsTo(TypeDevice::class);
    }

    public function model()
    {
        return $this->belongsTo(ModelDevice::class);
    }

}
