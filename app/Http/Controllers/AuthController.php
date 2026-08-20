<?php

namespace App\Http\Controllers;

use App\Models\AffiliateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAccount;

class AuthController extends Controller
{
    public function Register(Request $request){
        
        $validated = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:affiliate_users',
            'password' => 'required|min:8',
            'country' => 'required|string'
        ]);

        $userId = uniqid('IRU_AFF_');
        $referralCode = uniqid('AFF_');

        $user = AffiliateUser::create([
            'user_id' => $userId,
            'email' => $validated['email'],
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'password' => Hash::make($validated['password']),
            'country' => $validated['country'],
            'referral_code' => $referralCode
        ]);

        UserAccount::create([
            'user_id' => $userId,
            'referral_code' => $referralCode,
            'withdraw' => 0,
            'total_earnings' => 0,
            'balance' => 0
        ]);


        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "status" => "success",
            "message" => "registration successful",
            'token' => $token
        ], 201);
    }

    public function Login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $validated['email'];
        $password = $validated['password'];

        $user = AffiliateUser::where('email', $email)->first();

        if (!$user){
            return response()->json([
                "status" => "error",
                "message" => "User do not exist",
            ]);
        }

        if (!Hash::check($password, $user->password)){
            return response()->json([
                "status" => "error",
                "message" => "Wrong password",
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "status" => "success",
            "message" => "user retrieved successful",
            'token' => $token
        ]);
    }

    public function Logout(Request $request){

        return response()->json([
            "status" => "success",
            "message" => "Logout successfully",
        ]);
    }
}
