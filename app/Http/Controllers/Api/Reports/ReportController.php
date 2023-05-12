<?php

namespace App\Http\Controllers\Api\Reports;

use App\Http\Controllers\Controller;
use App\Http\Resources\Reports\aiDiseaseReportResource;
use App\Http\Resources\Reports\medicalInfoDetailsResource;
use App\Http\Resources\Reports\QuestionsOfLatestTipsResource;
use App\Http\Resources\Reports\TeethReportResource;
use App\Http\Resources\Reports\vaccineReportResource;
use App\Http\Traits\HttpResponseJson;
use App\Models\AiDisease;
use App\Models\Growth;
use App\Models\MedicalDetail;
use App\Models\Result;
use App\Models\TeethDevelopment;
use App\Models\Tips;
use App\Models\User;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    use HttpResponseJson;
    public function medical_details_info(){

        $info = MedicalDetail::with('user')->where('user_id',Auth::guard('api')->id())->first();

        if(isset($info) && !empty($info)){

            return $this->responseJson(new medicalInfoDetailsResource($info),null,true);

        }

        return $this->responseJson(null,'لا يوجد تفاصيل طبية للمستخدم حتى الان',true);

    }

    public function latestTipWithQuestions(){

        $question_ids = Result::where('user_id',Auth::guard('api')->id())->where('status',1)->pluck('question_id');


        $tips = Tips::with('questions')->whereHas('questions',function ($q) use ($question_ids){

            return $q->whereIn('questions.id',$question_ids);

        })->latest()->first();



        if(isset($tips) && !empty($tips)) {

            return $this->responseJson(new QuestionsOfLatestTipsResource($tips),null,true);

        }
        return $this->responseJson(null,'لا توجد ملاحظات لطفلك حتى الان',true);




    }

    public function teethReport(){

        $teeth = TeethDevelopment::with('teeth')->
        where('user_id',Auth::guard('api')->id())->latest()->first();

        if(isset($teeth) && !empty($teeth)) {


            return $this->responseJson( new TeethReportResource($teeth),null,true);

        }

        return $this->responseJson(null,'لا يوجد سجل خاص بالاسنان لطفلك حتى الان',true);



    }

    public function vaccinationsReport(){


        $vaccinations =  Vaccination::whereHas('userVaccines',function ($q){
            return $q->where('user_id',Auth::guard('api')->id())->where('status',1);
        })->get();


        if(isset($vaccinations) && $vaccinations->count()>0) {


            return $this->responseJson(vaccineReportResource::collection($vaccinations),null,true);

        }

        return $this->responseJson($vaccinations,'حتي الان لا يوجد اي تطعميات لطفلك',true);



    }


    public function aiDiseaseReport(){

        $diseases = AiDisease::where('user_id',Auth::guard('api')->id())
            ->where('prediction',1)->get();

        if(isset($diseases) && $diseases->count()>0) {


            return $this->responseJson(aiDiseaseReportResource::collection($diseases),null,true);

        }

        return $this->responseJson($diseases,'لا يوجد حتي الان اي امراض اصيب بها طفلك',true);



    }


    public function growthReport()
    {
        $growth = Growth::where('user_id',Auth::guard('api')->id())->latest()->first();

        if(!empty($growth)){

            return $this->responseJson($growth,null,true);
        }

        return $this->responseJson(null,'لا يوجد سجل مرضي خاص بنمو الطفل حتى الان',true);
    }



}
