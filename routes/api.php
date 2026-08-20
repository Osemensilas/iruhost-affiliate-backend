<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*Autorization Route*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'Login']);
Route::post('/logout', [AuthController::class, 'Logout'])->middleware('auth:sanctum');

/*User Controller Route*/
Route::middleware('auth:sanctum')->get('/fetch-user', [UserController::class, 'FetchUser']);
