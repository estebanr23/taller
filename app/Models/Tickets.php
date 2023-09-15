<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $table = 'tickets';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['id', 'description','customer_id'];


}
