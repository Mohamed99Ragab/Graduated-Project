<?php

namespace App\Http\Controllers;

use App\Http\Traits\ChildTrait;
use App\Http\Traits\HttpResponseJson;
use App\Models\MedicationReminder;
use App\Models\Teeth;
use App\Models\User;
use App\Models\Vaccination;
use App\Notifications\MedicationReminderNotification;
use App\Notifications\TeethReminderNotification;
use App\Notifications\VaccinationReminderNotification;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    use HttpResponseJson, ChildTrait;

    public function userTest()
    {


        return User::with('medicalDetails')->find(3);
    }

    public function test()
    {

        return date_format(Carbon::now()->addHour(),'g a');




    }
}
