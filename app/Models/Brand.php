<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'brand_name'
    ];

    public function models()
    {
        return $this->hasMany(ModelDevice::class);
    }

    public function setBrandNameAttribute($value)
    {
        $this->attributes['brand_name'] = strtoupper($value);
    }
}
