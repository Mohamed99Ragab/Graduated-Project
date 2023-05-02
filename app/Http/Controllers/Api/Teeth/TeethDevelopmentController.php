<?php

namespace App\Http\Controllers\Api\Teeth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teeth\TeethDevelopmentRequest;
use App\Http\Resources\TeethResource;
use App\Http\Traits\ChildTrait;
use App\Http\Traits\HttpResponseJson;
use App\Models\TeethDevelopment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TeethDevelopmentController extends Controller
{

        use HttpResponseJson , ChildTrait;


       public function index(){

           $teeth_devs = TeethDevelopment::with('teeth')->where('user_id',Auth::guard('api')->id())->get();


           if (isset($teeth_devs)& $teeth_devs->count()>0){

               return $this->responseJson(TeethResource::collection($teeth_devs) ,null,true);
           }
           return $this->responseJson($teeth_devs,'لا يوجد سجل للاسنان حتى الان',true);
       }

       public function get_single_teeth($teeth_id){

           $teeth_devs = TeethDevelopment::find($teeth_id);

           if (isset($teeth_devs)){
               return $this->responseJson(new TeethResource($teeth_devs),null,true);
           }


           return $this->responseJson(null,'لا توجد سنة بهذا المعرف',true);

       }





    public function store_teeth_dev(TeethDevelopmentRequest $request){

        try {

            //get birthdate of user
            $user = User::find(Auth::guard('api')->id());


            //calc difference between apperance teeth date and birth date of child
            // using method calc child age in trait ChildTrait

            $ages = $this->calc_child_age($request->apperance_date,$user->birth_date);



            TeethDevelopment::create([
                'user_id'=>$user->id,
                'apperance_date'=>$request->apperance_date,
                'teeth_id'=>$request->teeth_id,
                'age_in_years'=>$ages['years'],
                'age_in_months'=>$ages['months'],
                'age_in_days'=>$ages['days'],

            ]);

            return $this->responseJson(null,'تم حفظ البيانات بنجاح',true);




        }

        catch (\Exception $e){
            return $this->responseJson($e->getMessage(),'حدث خطاء ما في عملية الحفظ',false);
        }
    }



    public function update_teeth_dev(TeethDevelopmentRequest $request,$teeth_id){

        try {

            //get birthdate of user
            $user = User::find(Auth::guard('api')->id());


            //calc difference between apperance teeth date and birth date of child
            // using method calc child age in trait ChildTrait

            $ages = $this->calc_child_age($request->apperance_date,$user->birth_date);


            //make update
            $teeth = TeethDevelopment::find($teeth_id);

            if (isset($teeth)){
                $teeth->update([
                    'user_id'=>$user->id,
                    'apperance_date'=>$request->apperance_date,
                    'teeth_id'=>$request->teeth_id,
                    'age_in_years'=>$ages['years'],
                    'age_in_months'=>$ages['months'],
                    'age_in_days'=>$ages['days'],
                ]);

                return $this->responseJson(null,'تم تعديل البيانات بنجاح',true);

            }

            return $this->responseJson(null,'لا يمكن التعديل على عنصر غير موجود',false);


        }

        catch (\Exception $e){
            return $this->responseJson($e->getMessage(),'حدث خطاء ما في عملية التعديل',false);

        }



    }



    public function delete_teeth_dev($id){

        $teeth  = TeethDevelopment::find($id);
        if (isset($teeth)){
            $teeth->delete();
            return $this->responseJson(null,'تم ازالة السنة بنجاح',true);
        }

        return $this->responseJson(null,'لا توجد سنة بهذا المعرف لتتم عملية الحذف',false);

    }


}
