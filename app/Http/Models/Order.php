<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_id',
        'order_date',
        'quantity',
        'discount',
        'reg_by',
        'total',
        'supplier_name',
        'product_name',
        'supplier_phone'
    ];
}
