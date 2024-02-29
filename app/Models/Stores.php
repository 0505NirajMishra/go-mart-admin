<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stores extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stores';
    protected $primaryKey = 'store_id';
    
    protected $fillable = [
        'store_name',
        'category_name',
        'store_phone',
        'store_latitude',
        'store_longitude',
        'store_image',
        'store_address',
        'store_description',
        'store_opening_time',
        'store_closing_time',
        'store_status',
        'store_active',
    ];
    
}