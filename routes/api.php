<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RestPassword\ForgotPasswordController;
use App\Http\Controllers\Api\RestPassword\CodeCheckController;
use App\Http\Controllers\Api\RestPassword\ResetPasswordController;
use App\Http\Controllers\Api\SocialAuthController;
use App\Http\Controllers\Api\UpdateProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

    // rest password
    Route::post('password/email',  ForgotPasswordController::class);
    Route::post('password/code/check', CodeCheckController::class);
    Route::post('password/reset', ResetPasswordController::class);



    //login by google or facebook
    Route::post('/login/callback', [SocialAuthController::class,'token']);


});


Route::post('update-profile/{user_id}',[UpdateProfile::class,'update']);



