<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class AffiliateUser extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'affiliate_users';

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'email',
        'password',
        'country',
        'referral_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function account(){
        return $this->hasOne(UserAccount::class, 'user_id', 'user_id');
    }
}