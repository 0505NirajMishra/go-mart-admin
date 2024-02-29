<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'gallerys';
    protected $primaryKey = 'gallery_id';
    
    protected $fillable = [
        'store_id',
        'gallery_image'
    ];
    
}