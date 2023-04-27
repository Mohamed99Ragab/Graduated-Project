<?php

namespace App\Http\Controllers\Api\Reminder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reminder\MedicationReminderRequest;
use App\Http\Resources\ReminderResource;
use App\Http\Traits\HttpResponseJson;
use App\Models\MedicationReminder;
use App\Models\MedicineDay;
use App\Models\MedicineTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Collection;

class MedicationReminderController extends Controller
{

    use HttpResponseJson;



    public function index(){


        $reminders = MedicationReminder::where('user_id',Auth::guard('api')->id())->get();


        if (isset($reminders)& $reminders->count()>0){


            return $this->responseJson(ReminderResource::collection($reminders),null,true);

        }
        return $this->responseJson(null,'لا يوجد سجل خاص بالادوية حتى الان',false);
    }



    public function get_single_reminder($reminder_id){

        $reminder = MedicationReminder::with('medcineTimes')->where('id',$reminder_id)->where('user_id',Auth::guard('api')->id())->first();

        if (isset($reminder)){





            return $this->responseJson(new ReminderResource($reminder),null,true);

        }

        return $this->responseJson(null,'هذا المعرف غير موجود',false);


    }



    public function store_reminder(MedicationReminderRequest $request){


        DB::beginTransaction();
        $mediceTimes = $request->mediceTimes;

        try {


            $reminder = MedicationReminder::create([
                'user_id'=>Auth::guard('api')->id(),
                'medicine_name'=>$request->medicine_name,
                'appointment'=>$request->appointment,
                'start_date'=>date_format(Carbon::now(),'Y-m-d'),
                'end_date'=>$request->end_date
            ]);


            foreach ($mediceTimes as $mediceTime){

               $medicine_time = MedicineTime::create([

                    'quantity'=>$mediceTime['quantity'],
                    'time'=>$mediceTime['time'],
                    'month'=>$mediceTime['month'],
                    'medication_reminder_id'=>$reminder->id,
                ]);


               if(isset($mediceTime['days'])){
                   $medicine_time->medicinedays()->sync($mediceTime['days']);
               }


            }




            DB::commit();
            return $this->responseJson(null,'تم حفظ البيانات بنجاح',true);

        }

        catch (\Exception $e){

            DB::rollback();
            return $this->responseJson($e->getMessage(),'حدث خطاء ما في عملية الحفظ',false);

        }




    }


    public function update_reminder(MedicationReminderRequest $request , $reminder_id){



        DB::beginTransaction();
        $mediceTimes = $request->mediceTimes;
//        return $mediceTimes;

        try {

            $reminder = MedicationReminder::find($reminder_id);

            if (isset($reminder)){


                $reminder->update([
                    'user_id'=>Auth::guard('api')->id(),
                    'medicine_name'=>$request->medicine_name,
                    'appointment'=>$request->appointment,
                    'month'=>$request->month,
                    'end_date'=>$request->end_date
                ]);



                $medcine_times_ids = MedicineTime::where('medication_reminder_id',$reminder_id)->pluck('id');

                $count_items = count($mediceTimes);
                for($i = 0; $i<$count_items; $i++)
                {
                    $medcine_time = MedicineTime::find($medcine_times_ids[$i]);
                    $medcine_time->update([
                        'quantity' => $mediceTimes[$i]['quantity'],
                        'time' => $mediceTimes[$i]['time'],
                        'medication_reminder_id' => $reminder_id,
                    ]);


                    if(isset($mediceTimes[$i]['days'])){

                        $medcine_time->medicinedays()->sync($mediceTimes[$i]['days']);

                    }



                }



                DB::commit();
                return $this->responseJson(null,'تم تحديث البيانات بنجاح',true);
            }

            return $this->responseJson(null,'لا يوجد دواء بهذا المعرف',false);





        }

        catch (\Exception $e){

            DB::rollback();
            return $this->responseJson($e->getMessage(),'حدث خطاء ما في عملية التحديث',false);

        }




    }


    public function delete_reminder($id){

        $reminder  = MedicationReminder::find($id);
        if (isset($reminder)){
            $reminder->delete();
            return $this->responseJson(null,'تم حذف الدواء من السجل بنجاح',true);
        }

        return $this->responseJson(null,'لا يوجد دواء بهذا المعرف لتتم عملية الحذف',false);

    }


}
