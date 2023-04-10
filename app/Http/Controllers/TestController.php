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

        $user = User::find(1);
        $vaccine = Vaccination::find(1);
        $date_now = date_format(Carbon::now(),'Y-m-d');
        $birth_date = $user->birth_date;

        $ages = $this->calc_child_age($birth_date,$date_now);

        $vaccine_date = date_format(Carbon::parse($birth_date)->addMonths($vaccine->vaccine_age - $ages['months'])->subDays(2),'Y-m-d');

//        return $ages['months'];
        return $vaccine_date;

    }
}
