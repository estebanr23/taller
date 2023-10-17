<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelDevice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'models';
    public $timestamps = false;
    
    protected $fillable = ['model_name', 'brand_id', 'deleted_at'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function setModelNameAttribute($value)
    {
        $this->attributes['model_name'] = strtoupper($value);
    }
}
