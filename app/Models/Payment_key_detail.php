<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment_key_detail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payment_key_details';
    protected $primaryKey = 'payment_key_id';
    
    protected $fillable = [
        'razorpay_status',
        'sandbox_mode_status',
        'razorpay_key',
        'razorpay_secret',
    ];
}