<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $fillable = ['area_name', 'secretary_id'];

    public function secretary()
    {
        return $this->belongsTo(Secretary::class);
    }

    public function setAreaNameAttribute($value)
    {
        $this->attributes['area_name'] = strtoupper($value);
    }
}
