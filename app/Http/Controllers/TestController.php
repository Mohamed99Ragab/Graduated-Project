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

//        return date_format(Carbon::now()->addHour(),'g a');


        $users = User::all();

        foreach ($users as $user){

            if($user->is_reminder_vaccine == 1){


                //calc age of user in months
                $date_now = date_format(Carbon::now(),'Y-m-d');
                $birth_date = $user->birth_date;

                $ages = $this->calc_child_age($birth_date,$date_now);


                // this query to get vaccines that same age of user and user no take this vaccines
                // دا استعلام لجلب التطعيمات التى لم ياخدها الطفل حتى الان

                $vaccinations = Vaccination::whereDoesntHave('userVaccines',function ($q) use ($user) {
                    return $q->where('user_id',$user->id)->where('status',1);
                })->get();

                if(isset($vaccinations) && $vaccinations->count() > 0){

                    foreach ($vaccinations as $vaccination){

                        $vaccine_date = date_format(Carbon::parse($birth_date)->addMonths($vaccination->vaccine_age - $ages['months'])->subDays(1),'Y-m-d');

                        if($vaccine_date == $date_now)
                        {
                            $user->notify(new VaccinationReminderNotification('تذكير بمعياد اخذ التطعيمات',
                                "$user->name مرحبا ".' '.'نذكرك ميعاد اخذ'.' '.$vaccination->name.' '.'اليوم لطفلك'));
                        }

                    }
                }
            }

        }


    }
}
