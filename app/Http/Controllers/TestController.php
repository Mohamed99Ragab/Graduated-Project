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

        foreach ($users as $user){

            $reminders = MedicationReminder::where('user_id',$user->id)->where('appointment','اسبوعيا')->get();

            foreach ($reminders as $reminder){
                if ($reminder->end_date > date_format(Carbon::now(),'Y-m-d')) {



                    $times = $reminder->medcineTimes;

                    foreach ($times as $time) {
                        $days = $time->medicinedays;

                        foreach ($days as $day) {


                            if ($day->day == Carbon::now()->dayName && date_format(Carbon::parse($time->time), 'h') == date_format(Carbon::now()->addHour(), 'h')) {


                                $user->notify(new MedicationReminderNotification('تذكير موعد العلاج', " موعد اخذ الدواء " . $reminder->medicine_name . " الان"));
                            }
                        }
                    }
                }
            }


        }





    }
}
