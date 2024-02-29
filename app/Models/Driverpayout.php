<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driverpayout extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'driverpayouts';
    protected $primaryKey = 'driver_id';
    
    protected $fillable = [
        'driver_name',
        'amount',
        'note'
    ];

}