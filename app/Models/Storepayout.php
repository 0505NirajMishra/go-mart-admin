<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Storepayout extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'storepayouts';
    protected $primaryKey = 'store_id';
    
    protected $fillable = [
        'store_name',
        'amount',
        'note'
    ];

}