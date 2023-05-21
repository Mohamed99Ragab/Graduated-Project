<?php

namespace App\Http\Controllers\Api\MedicalDetails;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMedicalDetailsRequest;
use App\Http\Traits\FilesManagement;
use App\Http\Traits\HttpResponseJson;
use App\Models\MedicalDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicalDetailsController extends Controller
{
    use FilesManagement;
    use HttpResponseJson;

    public function storeMedicalDetails(StoreMedicalDetailsRequest $request){

        try {
            $medical_info = MedicalDetail::where('user_id',Auth::guard('api')->id())->first();

            if(empty($medical_info)){
                $medical_info =  MedicalDetail::create([
                    'user_id'=>Auth::guard('api')->id(),
                    'blood_type'=>$request->blood_type,
                    'allergy'=>$request->allergy,
                    'skin_disease'=>$request->skin_disease,
                    'chronic_disease'=>$request->chronic_disease,
                    'genetic_disease'=>$request->genetic_disease,
                    'Is_medicine'=>$request->Is_medicine,
                ]);


                return $this->responseJson($medical_info,'تم الحفظ بنجاح',true);
            }
            return $this->responseJson(null,'عذرا يمكنك اضافة التفاصيل الطبية مرة واحدة فقط',false);


        }
        catch (\Exception $e){

            return $this->responseJson($e->getMessage(),'حدث خطاء ما الرجاء المحاولة مرة اخرى',false);

        }

    }

    public function updateMedicalDetails(StoreMedicalDetailsRequest $request){

        try {


            $medical_info = MedicalDetail::where('user_id',Auth::guard('api')->id())->first();
            if(!empty($medical_info))
            {

                $medical_info->update([
                    'blood_type'=>$request->blood_type,
                    'allergy'=>$request->allergy,
                    'skin_disease'=>$request->skin_disease,
                    'chronic_disease'=>$request->chronic_disease,
                    'genetic_disease'=>$request->genetic_disease,
                    'Is_medicine'=>$request->Is_medicine,
                ]);

                return $this->responseJson($medical_info,'تم تحديث البيانات بنجاح',true);

            }
            return $this->responseJson(null,'لا يوجد تفاصيل طبية لاتمام العملية',false);


        }
        catch (\Exception $e){

            return $this->responseJson($e->getMessage(),'حدث خطاء ما الرجاء المحاولة مرة اخرى',false);

        }

    }

    public function showMedicalDetails()
    {
        $medical_info = MedicalDetail::where('user_id',Auth::guard('api')->id())->first();

        if (!empty($medical_info))
        {
            return $this->responseJson($medical_info,null,true);
        }
        return $this->responseJson(null,'لا توجد تفاصيل طبية مضافة',true);

    }



}
