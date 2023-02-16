<?php

use App\Http\Controllers\Dashboard\Auth\AdminController;
use App\Http\Controllers\Dashboard\Auth\ForgetPasswordController;
use App\Http\Controllers\Dashboard\DevelopmentFollow\QuestionController;
use App\Http\Controllers\Dashboard\DevelopmentFollow\SubjectController;
use App\Http\Controllers\Dashboard\DevelopmentFollow\TipsController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\VaccinationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TestController;
use App\Models\User;
use App\Notifications\VaccinationReminderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [HomeController::class,'index'])
    ->middleware('auth:admin')->name('dashboard');


Route::get('/', function () {
    return view('dashboard.login');
})->middleware('guest:admin')->name('login');



Route::get('/privacy', function () {
    return view('privacy');
});


// Auth route

Route::post('login',[AdminController::class,'login']);
Route::get('logout',[AdminController::class,'logout']);

// rest password
Route::get('forget-password',[ForgetPasswordController::class,'forget_password'])->name('password.forget');
Route::post('send-to-email',[ForgetPasswordController::class,'send_to_email'])->name('send.email');
Route::get('rest-password/{token}',[ForgetPasswordController::class,'rest_password_form']);
Route::post('rest-password',[ForgetPasswordController::class,'rest_password'])->name('password.rest');


Route::group(['middleware'=>'auth:admin'],function (){


    //admins
    Route::get('edit-profile',[AdminController::class,'edit_profile']);
    Route::post('update-profile',[AdminController::class,'update_profile']);





    // Development Follow
    // Subjects
    Route::resource('subjects',SubjectController::class);

    // Questions
    Route::resource('questions',QuestionController::class);

    // Tips
    Route::resource('tips',TipsController::class);

    // Vaccinations
    Route::resource('vaccinations',VaccinationController::class);

    // Reviews
    Route::get('reviews',[ReviewController::class,'index']);
    Route::delete('reviews/delete/{review_id}',[ReviewController::class,'delete_review']);

    //notifications
    Route::get('read-all',[HomeController::class,'read_all_notification']);






});







Route::get('/auth/redirect',[\App\Http\Controllers\SocialAuthController::class,'google_redirect']);

Route::get('/auth/callback',[\App\Http\Controllers\SocialAuthController::class,'google_callback']);


Route::get('/auth/redirect/facebook',[\App\Http\Controllers\SocialAuthController::class,'facebook_redirect']);

Route::get('/auth/callback/facebook',[\App\Http\Controllers\SocialAuthController::class,'facebook_callback']);



////////// test //////////////
Route::get('test',[TestController::class,'test']);
Route::get('vaccine',[TestController::class,'vaccine_notify']);
Route::get('userReminder',[TestController::class,'userReminder']);




Route::get('notify',function (){

    $user = User::first();
    $user->notify(new VaccinationReminderNotification());
    return 'ok';
});



Route::get('repeater',function (){

    return view('dashboard.repeater');
});

Route::post('repo',function (Request $request){

    foreach ($request->users as $user){
        return $user->name;
    }
})->name('repo');
