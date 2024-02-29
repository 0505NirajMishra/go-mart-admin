<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class wallettransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'wallettransaction';
    protected $primaryKey = 'wallet_id';
    
    protected $fillable = [
        'name',
        'order_amount',
        'order_type',
        'order_status',
    ];

}