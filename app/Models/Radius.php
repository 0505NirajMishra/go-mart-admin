<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Radius extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'radiuss';
    protected $primaryKey = 'radius_id';
    
    protected $fillable = [
        'store_nearby',
        'radius_nearby'
    ];

}