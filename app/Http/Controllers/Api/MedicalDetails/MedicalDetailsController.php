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

            MedicalDetail::create([
                'user_id'=>Auth::guard('api')->id(),
                'blood_type'=>$request->blood_type,
                'allergy'=>$request->allergy,
                'skin_disease'=>$request->skin_disease,
                'chronic_disease'=>$request->chronic_disease,
                'genetic_disease'=>$request->genetic_disease,
                'Is_medicine'=>$request->Is_medicine,
                'medicine_file'=> $request->hasFile('medicine_file') ? $request->file('medicine_file')->hashName():null
            ]);

            //upload medicine file if found
            $this->uploadImage($request->file('medicine_file'),'medicains','images');

//        return response()->json(['message'=>'تم الحفظ بنجاح'],'201');
            return $this->responseJson(null,'تم الحفظ بنجاح',true);
        }
        catch (\Exception $e){

            return $this->responseJson($e->getMessage(),'حدث خطاء ما الرجاء المحاولة مرة اخرى',false);

        }

    }




    public function all_allergies(){

        $allergies = DB::table('allergies')->select('allergy')->get();

        return $this->responseJson($allergies->toArray(),null,true);


    }

    public function all_chronic(){

        $chronic_diseases = DB::table('chronic_diseases')->select('disease')->get();

        return $this->responseJson($chronic_diseases,null,true);


    }

    public function all_skin(){

        $skin_diseases = DB::table('skin_diseases')->select('disease')->get();

        return $this->responseJson($skin_diseases->toArray(),null,true);


    }


    public function all_genetic(){

        $genetic_diseases = DB::table('genetic_diseases')->select('disease')->get();

        return $this->responseJson($genetic_diseases,null,true);


    }

}
