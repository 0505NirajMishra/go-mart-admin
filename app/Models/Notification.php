<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notifications';
    protected $primaryKey = 'notification_id';

    protected $fillable = [
        'notification_subject',
        'notification_message',
        'notification_send_to',
        'notification_date',
        'user_id'
    ];
}
