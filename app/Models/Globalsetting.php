<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Globalsetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'globals';
    protected $primaryKey = 'global_id';

    protected $fillable = [
        'application_name',
        'application_logo',
        'application_color',
        'currency_name',
        'currency_code',
        'currency_symbol',
        'address',
        'email',
        'phone',
        'razorpay_key',
        'razorpay_secert'
    ];

}
