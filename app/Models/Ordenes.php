<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ordenes extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'orders';
    public $timestamps = false;

    protected $fillable = ['id', 'device_id', 'customer_id','receiver_user','user_id','problem', 'accessories','report_customer',
    'report_technical','date_emission', 'date_promise', 'date_delivery','state_id','type_order','remote_repair','ticket_id'];


    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function Device()
    {
        return $this->belongsTo(Device::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function State()
    {
        return $this->belongsTo(State::class);
    }

    public function Tickets()
    {
        return $this->belongsTo(Tickets::class);
    }

    public function Receptor() // Obtener usuario receptor de orden
    {
        return $this->belongsTo(User::class, 'receiver_user', 'id');
    }

}
