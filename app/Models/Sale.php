<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'cashier_name',
        'sales_id',
        'customer_name',
        'discount',
        'total',
        'method_of_payment',
        'customer_phone',
        'is_having_debts',
        'debt_id',
        'debt_balance',
        'on_hold',
        'reg_by',
        'profit_margin'
    ];
}
