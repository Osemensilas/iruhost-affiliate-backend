<?php

namespace App\Http\Controllers;

use App\Models\AffiliateUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function FetchUser(Request $request){

        $userId = $request->user()->user_id;

        $user = AffiliateUser::with('account')->where('user_id', $userId)->first();

        return response()->json([
            "status" => "success",
            "message" => "User Retrieved successfully",
            "user" => $user
        ]);
    }

    public function GetReferrals(Request $request){
        $userId = $request->user()->user_id;

        $user = AffiliateUser::with('account')->where('user_id', $userId)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Affiliate user not found'
            ], 404);
        }

        $referralCode  = $user['referral_code'];

        $referrals = User::where('referred_by', $referralCode)->get();

        return response()->json([
            "status" => "success",
            "message" => "From get referrals",
            "referrals" => $referrals,
        ]);
    }
}
