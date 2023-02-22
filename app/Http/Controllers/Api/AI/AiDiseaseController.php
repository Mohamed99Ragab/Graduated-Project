<?php

namespace App\Http\Controllers\Api\AI;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAiDiseaseRequest;
use App\Http\Resources\AiDiseaseResource;
use App\Http\Traits\FilesManagement;
use App\Http\Traits\HttpResponseJson;
use App\Models\AiDisease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AiDiseaseController extends Controller
{

        use HttpResponseJson , FilesManagement;


        public function index(){

            $diseases =  AiDiseaseResource::collection(
                AiDisease::where('user_id',Auth::guard('api')->id())->get()
            );


            if (isset($diseases)& $diseases->count()>0){
                return $this->responseJson($diseases,null,true);
            }
            return $this->responseJson(null,'لا يوجد اي عمليات تنباء فى سجل الامراض حتى الان',false);
        }


    public function store_ai_disease(StoreAiDiseaseRequest $request){

        try {

            if (isset($request->validator) && $request->validator->fails()) {

                return $this->responseJson(null,$request->validator->messages(),false);
            }

            AiDisease::create([
                'user_id'=>Auth::guard('api')->id(),
                'prediction'=>$request->prediction,
                'disease_photo'=>$request->file('photo')->hashName()
            ]);

            // upload photo on server
            $this->uploadImage($request->file('photo'),'diseases','images');



            return $this->responseJson(null,'تم حفظ البيانات بنجاح',true);


        }

        catch (\Exception $e){
            return $this->responseJson($e->getMessage(),'حدث خطاء ما في عملية الحفظ',false);
        }


    }


    public function delete_disease($id){


        $disease  = AiDisease::find($id);
        if (isset($disease)){
            $disease->delete();
            return $this->responseJson(null,'تم حذف المرض من سجل الامراض بنجاح',true);
        }

        return $this->responseJson(null,'هذا المعرف غير موجود',false);



    }

}
