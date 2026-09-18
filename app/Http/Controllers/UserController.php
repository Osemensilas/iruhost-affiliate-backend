<?php

namespace App\Http\Controllers;

use App\Models\AffiliateUser;
use App\Models\User;
use App\Models\Transactions;
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

        $referralCode = $user->referral_code;

        // Get all users referred by this affiliate
        $referredUserIds = User::where('referred_by', $referralCode)->pluck('user_id');

        // Get the 5 most recent products bought by those users
        $products = Transactions::whereIn('user_id', $referredUserIds)->latest()->limit(5)->get();

        foreach ($products as $product) {
            $user = User::where('user_id', $product->user_id)->first();

            $product->firstname = $user?->firstname;
            $product->lastname = $user?->lastname;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'From get referrals',
            'products' => $products
        ]);
    }
}
