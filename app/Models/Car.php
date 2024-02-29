<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cars';
    protected $primaryKey = 'car_id';
    
    protected $fillable = [
        'car_number',
        'car_name',
        'car_image',
        'driver_id',
    ];
    
}