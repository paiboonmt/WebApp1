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
        'payment_value',
        'discount',
        'discount_value',
        'vat3',
        'vat3_value',
        'vat7',
        'vat7_value',
        'price',
        'comment',
        'sdate',
        'edate',
        'total',
        'user',
    ];
}
