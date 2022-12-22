<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/privacy', function () {
    return view('privacy');
});


Route::get('/auth/redirect',[\App\Http\Controllers\SocialAuthController::class,'google_redirect']);

Route::get('/auth/callback',[\App\Http\Controllers\SocialAuthController::class,'google_callback']);



Route::get('/auth/redirect/facebook',[\App\Http\Controllers\SocialAuthController::class,'facebook_redirect']);

Route::get('/auth/callback/facebook',[\App\Http\Controllers\SocialAuthController::class,'facebook_callback']);
