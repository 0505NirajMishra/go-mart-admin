<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subcategorys';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'subcategory_name',
        'subcategory_image',
        'subcategory_desc',
        'category_id'
    ];

}