<?php

namespace App\Http\Controllers\Api\Vaccinations;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserVaccinationResource;
use App\Http\Traits\HttpResponseJson;
use App\Models\User;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Collection;

class VaccinationController extends Controller
{

    use HttpResponseJson;

    public function index(){

        $vaccinations =  Vaccination::with(['users'=>function ($q){
            return $q->where('user_id',Auth::guard('api')->id());
        }])->get();

        $vaccinations = UserVaccinationResource::collection($vaccinations);

        return $this->responseJson($vaccinations,null,true);
    }


    public function single_vaccine($vaccination_id){


        $vaccine = Vaccination::find($vaccination_id);

        if(isset($vaccine)){

            return $this->responseJson($vaccine,null,true);
        }

        return $this->responseJson(null,'لا يوجد تطعيم بهذا المعرف',true);

    }



    public function attach_vaccines_to_user(Request $request){


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
