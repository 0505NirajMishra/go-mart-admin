<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vats';
    protected $primaryKey = 'vat_id';
    
    protected $fillable = [
        'vat_lable',
        'vat_tax',
        'vat_type',
    ];

}