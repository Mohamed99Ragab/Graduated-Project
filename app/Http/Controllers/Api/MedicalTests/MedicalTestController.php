<?php

namespace App\Http\Controllers\Api\MedicalTests;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalTests\StoreMedicalTestRequest;
use App\Http\Requests\MedicalTests\UpdateMedicalTestRequest;
use App\Http\Resources\MedicalTestsResource;
use App\Http\Traits\FilesManagement;
use App\Http\Traits\HttpResponseJson;
use App\Models\medicalTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class MedicalTestController extends Controller
{

    use HttpResponseJson;
    use FilesManagement;


    public function index(){


        $medical_tests = MedicalTestsResource::collection(
            medicalTest::where('user_id',Auth::guard('api')->id())->get()
        );

        if (isset($medical_tests)& $medical_tests->count()>0){
            return $this->responseJson($medical_tests,null,true);
        }
        return $this->responseJson(null,'لا يوجد تحاليل طبية حتى الان',false);

    }


    public function get_single_test($test_id){

        $medical_test = medicalTest::find($test_id);
        $medical_test_res = new MedicalTestsResource($medical_test);

        if (!empty($medical_test)){
            return $this->responseJson($medical_test_res,null,true);
        }

        return $this->responseJson(null,'id لا يوجد تحليل بهذا ',false);



    }




    public function storeMedicalTest(StoreMedicalTestRequest $request){

        try {

            if (isset($request->validator) && $request->validator->fails()) {

                return $this->responseJson(null,$request->validator->messages(),false);
            }

            medicalTest::create([
                'user_id'=>Auth::guard('api')->id(),
                'lab_name'=>$request->lab_name,
                'type'=>$request->type,
                'lab_date'=>$request->date,
                'lab_file'=>$request->file('file')->hashName()
            ]);

            // upload file on server
            $this->uploadImage($request->file('file'),'tests','images');



            return $this->responseJson(null,'تم حفظ البيانات بنجاح',true);


        }

        catch (\Exception $e){
            return $this->responseJson($e->getMessage(),'حدث خطاء ما في عملية الحفظ',false);
        }


    }




    public function update_medical_test(UpdateMedicalTestRequest $request,$test_id){


        if (isset($request->validator) && $request->validator->fails()) {

            return $this->responseJson(null,$request->validator->messages(),false);
        }



//        return $request;
        $medical_test  = medicalTest::find($test_id);
        if (isset($medical_test)){


            $medical_test->user_id = Auth::guard('api')->id();
            $medical_test->lab_name = $request->lab_name;
            $medical_test->type = $request->type;
            $medical_test->lab_date = $request->date;

            if($request->hasFile('file')){
                // romove last file
                Storage::disk('images')->delete('tests/'.$medical_test->lab_file);
                // upload new file
                $this->uploadImage($request->file,'tests','images');
                //save new file in db
                $medical_test->lab_file = $request->file('file')->hashName();
            }
          $medical_test->save();

            $medical_test_res = new MedicalTestsResource($medical_test);
         return $this->responseJson(null,'تم تعديل البيانات بنجاح',true);

        }
        return $this->responseJson(null,'هذا التحليل الذى تحاول تعديله غير موجود',false);


    }




    public function delete_medical_test($id){

        $medical_test  = medicalTest::find($id);
        if (isset($medical_test)){
            $medical_test->delete();
            return $this->responseJson(null,'تم حذف التحليل بنجاح',true);
        }

        return $this->responseJson(null,'لا يوجد تحليل لتتم عملية الحذف',false);

    }


}
