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
        $users = User::all();
        $date_now = date_format(Carbon::now(),'Y-m-d');


        foreach ($users as $user){


            foreach ($user->unreadNotifications as $notification) {

//                if( date_format(Carbon::parse($notification->created_at)->addDays(7),'Y-m-d') == $date_now ){

                    $notification->delete();

                    return 'ok';

//                }
            }

        }








    }
}
