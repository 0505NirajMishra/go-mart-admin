<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stores;
use App\Models\Drivers;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'driver_id',
        'store_id',
        'user_id',
        'order_no',
        'coupon_id',
        'order_amount',
        'address',
        'order_time',
        'order_type',
        'order_date',
        'order_status',
        'payment_method'
    ];

    public function store(){
        return $this->belongsTo(Stores::class,'store_id','store_id');
    }

    public function driver(){
        return $this->belongsTo(Drivers::class, 'driver_id', 'driver_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function OrderQuantity(){
        return $this->belongsTo(OrderItem::class,'order_no','order_no');
    }

}
