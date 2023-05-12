<?php

namespace App\Http\Controllers\Api\Vaccinations;

use App\Http\Controllers\Controller;
use App\Http\Resources\SigleVaccinationResource;
use App\Http\Resources\UserVaccinationResource;
use App\Http\Traits\ChildTrait;
use App\Http\Traits\HttpResponseJson;
use App\Models\User;
use App\Models\UserVaccination;
use App\Models\Vaccination;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Collection;

class VaccinationController extends Controller
{

    use HttpResponseJson ,ChildTrait;

    public function index(){



        $vaccinations =  Vaccination::with(['userVaccines'=>function ($q){
            return $q->where('user_id',Auth::guard('api')->id());
        }])->get();





        $vaccinations = UserVaccinationResource::collection($vaccinations);

        if(isset($vaccinations) && $vaccinations->count() > 0)
        {
            return $this->responseJson($vaccinations,null,true);

        }
        return $this->responseJson($vaccinations,'لا يوجد تطعيمات حتى الان',true);
    }


    public function single_vaccine($vaccination_id){



        $vaccine = Vaccination::with(['userVaccines'=>function ($q){
            return $q->where('user_id',Auth::guard('api')->id());
        }])->find($vaccination_id);


        if(isset($vaccine)){



            return $this->responseJson(new SigleVaccinationResource($vaccine),null,true);
        }

        return $this->responseJson(null,'لا يوجد تطعيم بهذا المعرف',false);

    }



    public function attach_vaccines_to_user(Request $request){



        $rules = [
            'vaccination_id'=>'required|exists:vaccinations,id',

        ];

        $messages = [
            'vaccination_id.required'=>'هذا الحقل مطلوب',
            'vaccination_id.exists'=>'عفوا رقم التطعيم غير موجود'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails()){

            return $this->responseJson(null,$validator->errors()->first(),false);
        }


//            $user = User::find(Auth::guard('api')->id());

//            $user->vaccinations()->sync($request->vaccination_ids);

            $user_vaccine = UserVaccination::where('vaccination_id',$request->vaccination_id)
                ->where('user_id',Auth::guard('api')->id())->first();

            if(!empty($user_vaccine) && $user_vaccine->status ==1){
                $user_vaccine->update([
                    'status'=>0
                ]);

                return $this->responseJson(null,'تم ازالة التطعيم بنجاح',true);

            }elseif(!empty($user_vaccine) && $user_vaccine->status ==0)
            {
                $user_vaccine->update([
                    'status'=>1
                ]);

                return $this->responseJson(null,'تم اضافة التطعيم بنجاح',true);
            }

             UserVaccination::create([
                 'user_id'=>Auth::guard('api')->id(),
                 'vaccination_id'=>$request->vaccination_id,
                 'status'=>1
             ]);

            return $this->responseJson(null,'تم اضافة التطعيم بنجاح',true);


    }


    public function stop_reminder(Request $request){


        $user = User::find(Auth::guard('api')->id());

        if ($request->status == 0){

            $user->update([
                'is_reminder_vaccine'=>0
            ]);


            return $this->responseJson(null,'تم تعطيل خدمة الاشعارات الخاصة بالتطعيمات',true);

        }else{

            $user->update([
                'is_reminder_vaccine'=>1
            ]);


            return $this->responseJson(null,'تم تفعيل خدمة الاشعارات الخاصة بالتطعيمات',true);



        }


    }

}
