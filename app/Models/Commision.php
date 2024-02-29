<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commision extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'commissions';
    protected $primaryKey = 'commission_id';
    
    protected $fillable = [
        'commission_type',
        'admin_commission'
    ];

}