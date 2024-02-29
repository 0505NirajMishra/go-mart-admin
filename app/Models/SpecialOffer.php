<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialOffer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'specialoffers';
    protected $primaryKey = 'special_id';
    
    protected $fillable = [
        'enable_special_discount',
    ];

}