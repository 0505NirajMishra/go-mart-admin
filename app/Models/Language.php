<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'languages';
    protected $primaryKey = 'language_id';
    
    protected $fillable = [
        'language_name',
        'language_slug',
        'language_status'
    ];

}