<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adduseraddress extends Model
{
    use HasFactory;

    protected $table = 'useraddresss';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id',
        'order_id',
        'address',
        'zip',
        'city',
        'address_type',
        'building',
        'other_address'
    ];
}