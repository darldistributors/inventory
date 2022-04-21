<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'reg_by',
        'unit_cost',
        'supplier_name',
        'supplier_phone',
        'comapnay_name',
        'company_address',
    ];
}
