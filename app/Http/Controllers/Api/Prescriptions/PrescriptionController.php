<?php

namespace App\Http\Controllers\Api\Prescriptions;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalTests\StoreMedicalTestRequest;
use App\Http\Requests\MedicalTests\UpdateMedicalTestRequest;
use App\Http\Requests\Prescriptions\StorePrescriptionRequest;
use App\Http\Requests\Prescriptions\UpdatePrescriptionRequest;
use App\Http\Resources\MedicalTestsResource;
use App\Http\Resources\PrescriptionResource;
use App\Http\Traits\FilesManagement;
use App\Http\Traits\HttpResponseJson;
use App\Models\medicalTest;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PrescriptionController extends Controller
{

    use HttpResponseJson;
    use FilesManagement;


    public function index(){


        $prescriptions = PrescriptionResource::collection(
            Prescription::where('user_id',Auth::guard('api')->id())->get()
        );

        if (isset($prescriptions)& $prescriptions->count()>0){
            return $this->responseJson($prescriptions,null,true);
        }
        return $this->responseJson($prescriptions,'لا توجد روشتات حتى الان',true);

    }


    public function get_single_prescription($prescription_id){

        $prescription = Prescription::find($prescription_id);
        $prescription_res = new PrescriptionResource($prescription);

        if (!empty($prescription)){
            return $this->responseJson($prescription_res,null,true);
        }

        return $this->responseJson(null,'id لا توجد روشتة بهذا ',false);



    }




    public function storePrescription(StorePrescriptionRequest $request){

        try {

            Prescription::create([
                'user_id'=>Auth::guard('api')->id(),
                'note'=>$request->note,
                'date'=>$request->date,
                'file'=>$request->file('file')->hashName()
            ]);

            // upload file on server
            $this->uploadImage($request->file('file'),'prescriptions','images');



            return $this->responseJson(null,'تم حفظ البيانات بنجاح',true);


        }

        catch (\Exception $e){
            return $this->responseJson($e->getMessage(),'حدث خطاء ما في عملية الحفظ',false);
        }


    }




    public function update_prescription(UpdatePrescriptionRequest $request,$prescription_id){

        $prescription  = Prescription::find($prescription_id);
        if (isset($prescription)){


            $prescription->user_id = Auth::guard('api')->id();
            $prescription->note = $request->note;
            $prescription->date = $request->date;

            if($request->hasFile('file')){
                // romove last file
                Storage::disk('images')->delete('prescriptions/'.$prescription->file);
                // upload new file
                $this->uploadImage($request->file,'prescriptions','images');
                //save new file in db
                $prescription->file = $request->file('file')->hashName();
            }
            $prescription->save();

            $prescription_res = new PrescriptionResource($prescription);
         return $this->responseJson($prescription_res,'تم تعديل البيانات بنجاح',true);

        }
        return $this->responseJson(null,'هذة الروشتة غير موجودة',false);


    }




    public function delete_prescription($id){

        $prescription  = Prescription::find($id);
        if (isset($prescription)){
            $prescription->delete();
            return $this->responseJson(null,'تم حذف الروشتة بنجاح',true);
        }

        return $this->responseJson(null,'لا توجد روشتة لتتم عملية الحذف',false);

    }


}
