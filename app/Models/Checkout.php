<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $table = 'checkout';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id',
        'item_id',
        'item_name',
        'item_weight',
        'item_quantity',
        'item_price',
        'item_image',
        'item_dis_price',
        'item_total'
    ];
}