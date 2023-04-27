<?php

namespace App\Http\Controllers\Api\Vaccinations;

use App\Http\Controllers\Controller;
use App\Http\Resources\SigleVaccinationResource;
use App\Http\Resources\UserVaccinationResource;
use App\Http\Traits\ChildTrait;
use App\Http\Traits\HttpResponseJson;
use App\Models\User;
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

        $vaccinations =  Vaccination::with(['users'=>function ($q){
            return $q->where('user_id',Auth::guard('api')->id());
        }])->get();

        $vaccinations = UserVaccinationResource::collection($vaccinations);


        return $this->responseJson($vaccinations,null,true);
    }


    public function single_vaccine($vaccination_id){


        $vaccine = Vaccination::with(['users'=>function ($q){
            return $q->where('user_id',Auth::guard('api')->id());
        }])->find($vaccination_id);


        if(isset($vaccine)){



            return $this->responseJson(new SigleVaccinationResource($vaccine),null,true);
        }

        return $this->responseJson(null,'لا يوجد تطعيم بهذا المعرف',true);

    }



    public function attach_vaccines_to_user(Request $request){


        $rules = [
            'vaccination_ids.*'=>'required|exists:vaccinations,id',
            'vaccination_ids'=>'array'
        ];

        $messages = [
            'vaccination_ids.*.required'=>'هذا الحقل مطلوب',
            'vaccination_ids.array'=>'يجب ان يكون هذا الحقل عبارة عن مصفوفة',
            'vaccination_ids.*.exists'=>'عفوا رقم التطعيم غير موجود'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails()){

            return $this->responseJson(null,$validator->errors()->first(),false);
        }


            $user = User::find(Auth::guard('api')->id());

            $user->vaccinations()->sync($request->vaccination_ids);

        return $this->responseJson(null,'تم اضافة تلك التطعيمات للمستخدم بنجاح',true);


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
