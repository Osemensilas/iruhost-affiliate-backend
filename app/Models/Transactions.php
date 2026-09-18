<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'transaction_id',
        'reference_id',
        'product',
        'product',
        'product_name',
        'amount',
        'details',
        'status',
    ];
}
