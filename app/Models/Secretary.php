<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
    use HasFactory;

    protected $table = 'secretaries';
    public $timestamps = false;
    protected $fillable = ['name'];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
