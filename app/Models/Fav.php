<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fav extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'favorites';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'item_id',
        'like_status'
    ];

}
