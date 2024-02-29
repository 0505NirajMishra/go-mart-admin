<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_items';
    protected $primaryKey = 'id';

    protected $fillable = [
        'order_no',
        'item_id',
        'item_name',
        'item_price',
        'quantity',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

}
