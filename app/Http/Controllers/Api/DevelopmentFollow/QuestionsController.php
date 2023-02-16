<?php

namespace App\Http\Controllers\Api\DevelopmentFollow;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionSelectedResource;
use App\Http\Resources\QuestionSubjectResource;
use App\Http\Resources\TipsResource;
use App\Http\Traits\ChildTrait;
use App\Http\Traits\HttpResponseJson;
use App\Models\Question;
use App\Models\Result;
use App\Models\Subject;
use App\Models\Tips;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{

    use HttpResponseJson ,ChildTrait;


    public function index(){


        $ages = $this->calc_child_age(Auth::guard('api')->user()->birth_date,date_format(Carbon::now(),'Y-m-d'));


        $questions = Question::with('subject')->where('age_stage',$ages['months'])->get();

        $questions = QuestionSubjectResource::collection($questions);

        return $this->responseJson($questions,null,true);


    }



    public function create_tips(Request $request){


            $answers = $request->answers;

        try {





            foreach ($answers as $answer){

                Result::create([
                    'user_id'=>Auth::guard('api')->id(),
                    'question_id'=>$answer['question_id'],
                    'status'=>$answer['status']
                ]);



            }
            return $this->responseJson(null,'تم حفظ البيانات بنجاح',true);


        }

        catch (\Exception $e){

            return $this->responseJson($e->getMessage(),'حدث خطاء ما',false);
        }




    }


    public function get_tips_by_question(){


        $question_ids = Result::where('user_id',Auth::guard('api')->id())->where('status',1)->pluck('question_id');


        $tips = Tips::with(['questions'=>function($q){
            return $q->select('age_stage');
        }])->whereHas('questions',function ($q) use ($question_ids){

            return $q->whereIn('questions.id',$question_ids);

        })->get();


        $tips = TipsResource::collection($tips);

        return $this->responseJson($tips,null,true);


    }


    public function selected_questions($tip_id){



        $tip = Tips::find($tip_id);



        if (isset($tip)){

            $questions = Question::with(['subject','tips'=>function ($q) use($tip_id){

                return $q->where('tips.id',$tip_id);
            }])->get();



            $questions = QuestionSelectedResource::collection($questions);

            return $this->responseJson($questions,null,true);
        }

        return $this->responseJson(null,'لا يوجد اسئلة خاصة بهذة الملاحظة',false);



    }

    public function update_tips(Request $request){


        $answers = $request->answers;

        try {


            $questions_ids = [];
            foreach ($answers as $answer){

                $questions_ids [] = $answer['question_id'];

            }



            $count_items = count($answers);
            for($i = 0; $i<$count_items; $i++)
            {
                $result = Result::where('question_id',$questions_ids[$i])->where('user_id',Auth::guard('api')->id());
                $result->update([
                    'status' => $answers[$i]['status'],

                ]);
            }



            return $this->responseJson(null,'تم حفظ البيانات بنجاح',true);


        }

        catch (\Exception $e){

            return $this->responseJson($e->getMessage(),'حدث خطاء ما',false);
        }




    }


}
