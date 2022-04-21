<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSales extends Model
{
    use HasFactory;
    protected $fillable = [
        'cashier_name',
        'product_name',
        'product_id',
        'selling_price',
        'cost_price',
        'profit_margin',
        'total_cost',
        'reg_by',
        'sale_id'
    ];
}
