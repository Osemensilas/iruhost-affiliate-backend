<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class UserAccount extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'affiliate_user_account';

    protected $fillable = [
        'user_id',
        'referral_code',
        'withdraw',
        'total_earnings',
        'balance',
    ];
}
