<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bank_details';
    protected $primaryKey = 'bank_id';
    
    protected $fillable = [
        'driver_id',
        'store_id',
        'bank_name',
        'branch_name',
        'holder_name',
        'account_number',
        'other_info'
    ];
    
}