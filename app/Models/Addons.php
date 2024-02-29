<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Addons extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'item_addons';
    protected $primaryKey = 'addons_id';
    
    protected $fillable = [
        'item_id',
        'addons_title',
        'addons_price',
    ];

}