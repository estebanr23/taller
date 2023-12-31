<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'states';
    public $timestamps = false;

    protected $fillable = ['id', 'name'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
}
