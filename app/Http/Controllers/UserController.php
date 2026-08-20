<?php

namespace App\Http\Controllers;

use App\Models\AffiliateUser;
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
}
