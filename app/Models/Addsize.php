<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Addsize extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'item_add_sizes';
    protected $primaryKey = 'item_add_id';
    
    protected $fillable = [
        'item_id',
        'add_size',
        'add_price',
    ];

}