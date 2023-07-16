<?php



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


use App\Http\Controllers\Api\DataAnalysis\AnlysisController;
use Illuminate\Support\Facades\Route;



Route::get('users',[AnlysisController::class,'users']);
Route::get('vaccines',[AnlysisController::class,'vaccinations']);
Route::get('user-vaccines',[AnlysisController::class,'user_vaccinations']);
Route::get('predictions',[AnlysisController::class,'ai_diseases']);
Route::get('medical-details',[AnlysisController::class,'medical_datails']);
Route::get('growth',[AnlysisController::class,'growth']);

Route::get('teeth',[AnlysisController::class,'teeth']);
Route::get('user-teeth',[AnlysisController::class,'user_teeth']);

Route::get('medical-tests',[AnlysisController::class,'medical_tests']);
Route::get('prescription',[AnlysisController::class,'prescription']);






