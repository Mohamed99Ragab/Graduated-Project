<?php

namespace App\Http\Controllers;

use App\Http\Traits\ChildTrait;
use App\Http\Traits\HttpResponseJson;
use App\Models\User;
use App\Models\UserTakenVaccine;
use App\Models\Vaccination;
use App\Notifications\MedicationReminderNotification;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    use HttpResponseJson , ChildTrait;
    public function userTest(){

        return User::with('medicalDetails')->find(3);
    }

    public function test(){




//       return date_format(Carbon::now(),'Y-m-d');
//        return date_format(Carbon::now(),'h:i:s');


        $user = User::find(1);
        $noti = [];
        foreach ($user->notifications as $notification) {

            $noti[] = $notification->data;
//           return $notification->data;
        }
        return $noti;


//        $user = User::find(3);
//        return $user->vaccinations;

        // this query to get vaccines that same age of user and user no take this vaccines
        // دا استعلام لجلب التطعيمات التى نفس الفترة العمرية للطفل و لم ياخدها الطفل حتى الان
        $vacs = Vaccination::where('vaccine_age','0')->whereDoesntHave('users',function ($q){
            return $q->where('user_id',3);
        })->get();

        return $vacs;







//        $vaccines = UserTakenVaccine::where('user_id',3)->get();
//
//        $data = [];
//        foreach ($vaccines as $vaccine){
//
//            $data[] = $vaccine->where('vaccination');
//        }
//        return $data;
//
//
//
//        if (isset($vaccines)& $vaccines->count()>0){
//            return $this->responseJson($vaccines,null,true);
//        }
//        return $this->responseJson(null,'لا يوجد تطعيمات حتى الان',false);



    }


    public function userReminder()
    {
        $users = User::all();

        foreach ($users as $user) {

            foreach ($user->userTimes as $userTime) {
//                return date_format(Carbon::parse($userTime->time), 'h');

                $reminder = $userTime->reminder;
                if ($reminder->end_date != date_format(Carbon::now(), 'Y-m-d')) {


                    if (date_format($userTime->time, 'h') == date_format(Carbon::now(), 'h')) {
                        $user->notify(new MedicationReminderNotification('تذكير موعد العلاج', " موعد اخذ الدواء " . $reminder->medicine_name . " الان"));
                    }
                }


            }
        }

    }


    public function vaccine_notify(){

        $users = User::all();

        foreach ($users as $user){

            //calc age of user in months
            $date_now = date_format(Carbon::now(),'Y-m-d');
            $birth_date = $user->birth_date;

            $ages = $this->calc_child_age($birth_date,$date_now);


            // this query to get vaccines that same age of user and user no take this vaccines
            // دا استعلام لجلب التطعيمات التى نفس الفترة العمرية للطفل و لم ياخدها الطفل حتى الان
            $vaccinations = Vaccination::where('vaccine_age',$ages['months'])->whereDoesntHave('users',function ($q)use($user){
                return $q->where('user_id',$user->id);
            })->get();

            if(isset($vaccinations) & $vaccinations->count() >0){

                foreach ($vaccinations as $vaccination){

                    $user->notify(new MedicationReminderNotification('تذكير بمعياد اخذ التطعيمات',
                        'مرحبا '.$user->name.' '.'نذكرك ميعاد اخذ تطعيم'.' '.$vaccination->name.' '.'اليوم لطفلك'));
                }
            }




        }
    }


}
