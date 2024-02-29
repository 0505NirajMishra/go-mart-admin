<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ordertransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ordertransactions';
    protected $primaryKey = 'order_id';
    
    protected $fillable = [
        'driver_name',
        'order_amount',
        'store_name',
        'order_status',
    ];

}