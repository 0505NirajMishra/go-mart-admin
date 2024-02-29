<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drivers extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'drivers';
    protected $primaryKey = 'driver_id';
    
    protected $fillable = [
        'driver_name',
        'driver_image',
        'store_name',
        'driver_phone_number',
        'driver_email',
        'driver_address',
        'driver_status',
        'driver_longitude',
        'driver_latitude'
    ];
    
}