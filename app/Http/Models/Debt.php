<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'debt_id',
        'description',
        'total_debt_before',
        'total_debt_after',
        'amount_paid',
        'debt_type',
        'reg_by'
    ];
    // protected $guarded = [];
}
