<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deliverycharge extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'deliverycharges';
    protected $primaryKey = 'delivery_id';
    
    protected $fillable = [
        'delivery_charge_per_km',
        'minimum_delivery_charge',
        'minimum_delivery_charge_with_km'
    ];

}