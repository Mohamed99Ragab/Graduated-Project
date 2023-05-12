<?php

use App\Http\Controllers\Api\AI\AiDiseaseController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\CompleteProfileController;
use App\Http\Controllers\Api\Auth\SocialAuthController;
use App\Http\Controllers\Api\Auth\UpdateProfile;
use App\Http\Controllers\Api\DaysWeekController;
use App\Http\Controllers\Api\DevelopmentFollow\QuestionsController;
use App\Http\Controllers\Api\Growth\GrowthController;
use App\Http\Controllers\Api\MedicalDetails\MedicalDetailsController;
use App\Http\Controllers\Api\MedicalTests\MedicalTestController;
use App\Http\Controllers\Api\Notifications\NotificationController;
use App\Http\Controllers\Api\Prescriptions\PrescriptionController;
use App\Http\Controllers\Api\Reminder\MedicationReminderController;
use App\Http\Controllers\Api\Reports\ReportController;
use App\Http\Controllers\Api\RestPassword\CodeCheckController;
use App\Http\Controllers\Api\RestPassword\ForgotPasswordController;
use App\Http\Controllers\Api\RestPassword\ResetPasswordController;
use App\Http\Controllers\Api\Teeth\TeethController;
use App\Http\Controllers\Api\Teeth\TeethDevelopmentController;
use App\Http\Controllers\Api\Vaccinations\VaccinationController;
use App\Http\Controllers\ReviewController;
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


Route::group(['middleware'=>'jwt.verify'],function (){



    // update profile
    Route::post('update-profile',[UpdateProfile::class,'update']);

    // complete profile
    Route::post('complete-profile',[CompleteProfileController::class,'completeProfile']);


    // medical details
    Route::get('medicalDetails',[MedicalDetailsController::class,'showMedicalDetails']);
    Route::post('store-medical-details',[MedicalDetailsController::class,'storeMedicalDetails']);
    Route::post('medicalDetails',[MedicalDetailsController::class,'updateMedicalDetails']);
    Route::get('all-allergies',[MedicalDetailsController::class,'all_allergies']);
    Route::get('chronic-diseases',[MedicalDetailsController::class,'all_chronic']);
    Route::get('skin-diseases',[MedicalDetailsController::class,'all_skin']);
    Route::get('genetic-diseases',[MedicalDetailsController::class,'all_genetic']);

    // medical Tests
    Route::get('all-medical-test',[MedicalTestController::class,'index']);
    Route::post('store-medical-test',[MedicalTestController::class,'storeMedicalTest']);
    Route::get('get-single-medical-test/{test_id}',[MedicalTestController::class,'get_single_test']);
    Route::post('update-medical-test/{test_id}',[MedicalTestController::class,'update_medical_test']);
    Route::delete('delete-medical-test/{test_id}',[MedicalTestController::class,'delete_medical_test']);


    // prescriptions
    Route::get('all-prescription',[PrescriptionController::class,'index']);
    Route::post('store-prescription',[PrescriptionController::class,'storePrescription']);
    Route::get('get-single-prescription/{prescription_id}',[PrescriptionController::class,'get_single_prescription']);
    Route::post('update-prescription/{prescription_id}',[PrescriptionController::class,'update_prescription']);
    Route::delete('delete-prescription/{prescription_id}',[PrescriptionController::class,'delete_prescription']);



    // Teeth Development
    Route::post('store-teeth-dev',[TeethDevelopmentController::class,'store_teeth_dev']);
    Route::post('update-teeth-dev/{teeth_id}',[TeethDevelopmentController::class,'update_teeth_dev']);
    Route::delete('delete-teeth-dev/{teeth_id}',[TeethDevelopmentController::class,'delete_teeth_dev']);
    Route::get('get-single-teeth/{teeth_id}',[TeethDevelopmentController::class,'get_single_teeth']);
    Route::get('all-teeth-dev',[TeethDevelopmentController::class,'index']);
    // Teeth api
    Route::get('medical-teeths',[TeethController::class,'get_all_teeths']);



    // Medication Reminders
    Route::post('store-reminder',[MedicationReminderController::class,'store_reminder']);
    Route::put('update-reminder/{reminder_id}',[MedicationReminderController::class,'update_reminder']);
    Route::get('all-reminders',[MedicationReminderController::class,'index']);
    Route::get('get-single-reminder/{reminder_id}',[MedicationReminderController::class,'get_single_reminder']);
    Route::delete('delete-reminder/{reminder_id}',[MedicationReminderController::class,'delete_reminder']);

    // api to get all days of week
    Route::get('days',[DaysWeekController::class,'get_days']);


    // Ai Diseases
    Route::get('all-ai-diseases',[AiDiseaseController::class,'index']);
    Route::post('store-disease',[AiDiseaseController::class,'store_ai_disease']);
    Route::delete('delete-disease/{id}',[AiDiseaseController::class,'delete_disease']);


    // Vaccinations
    Route::post('attach-vaccination',[VaccinationController::class,'attach_vaccines_to_user']);
    Route::get('all-vaccinations',[VaccinationController::class,'index']);
    Route::get('single-vaccination/{vaccine_id}',[VaccinationController::class,'single_vaccine']);
    Route::post('stop-vaccination-reminder',[VaccinationController::class,'stop_reminder']);

    // Development Follow
    Route::get('get-questions',[QuestionsController::class,'index']);
    Route::post('create-tips',[QuestionsController::class,'create_tips']);

    Route::get('tips-of-user',[QuestionsController::class,'get_tips_by_question']);
    Route::get('get-questions-of-tip/{tip_id}',[QuestionsController::class,'selected_questions']);

    Route::post('update-tips',[QuestionsController::class,'update_tips']);


    // Reports Api
    Route::get('medical-info',[ReportController::class,'medical_details_info']);

    Route::get('development-follow-info',[ReportController::class,'latestTipWithQuestions']);

    Route::get('teeth-report',[ReportController::class,'teethReport']);

    Route::get('vaccine-report',[ReportController::class,'vaccinationsReport']);

    Route::get('disease-report',[ReportController::class,'aiDiseaseReport']);

    Route::get('growth-report',[ReportController::class,'growthReport']);






    // Reviews
    Route::post('make-review',[ReviewController::class,'store']);

    // Notifiactions
    Route::get('history-notify',[NotificationController::class,'history_of_notidfication']);
    Route::get('mark-as-read',[NotificationController::class,'mark_all_notificatis_as_read']);

    //   Growth of weights and heights
    Route::get('growth',[GrowthController::class,'index']);
    Route::post('calc-growth',[GrowthController::class,'calcGrowth']);



});





