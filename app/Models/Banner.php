<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'banners';
    protected $primaryKey = 'banner_id';
    
    protected $fillable = [
        'banner_image',
        'banner_title',
        'banner_publish',
        'set_order'
    ];


}