<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDevice extends Model
{
    use HasFactory;

    public $table = 'type_devices';
    public $timestamps = false;
    protected $fillable = ['type_name'];

    public function setTypeNameAttribute($value)
    {
        $this->attributes['type_name'] = strtoupper($value);
    }

}
