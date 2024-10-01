<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_orders extends Model
{
    use HasFactory;

    protected $fillable=[
        'ref_order_id',
        'customer',
        'payment',
        'discount',
        'vat3',
        'vat7',
        'price',
        'comment',
        'sdate',
        'edate',
        'total',
        'user_id',
    ];
}
