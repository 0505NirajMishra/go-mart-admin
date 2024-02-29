<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';
    protected $primaryKey = 'cat_id';
    
    protected $fillable = [
        'category_name',
        'category_image',
        'description',
        'language_id'
    ];

}