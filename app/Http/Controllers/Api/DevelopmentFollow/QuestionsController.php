<?php

namespace App\Http\Controllers\Api\DevelopmentFollow;

use App\Http\Controllers\Controller;
use App\Http\Requests\DevelopmentFollow\TipsRequest;
use App\Http\Requests\DevelopmentFollow\updateTipsRequest;
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

        if (isset($questions) && $questions->count() >0)
        {
            return $this->responseJson($questions,null,true);

        }
        return $this->responseJson($questions,'لا توجد اسئلة لنفس المرحلة العمرية الخاصة بك',true);


    }



    public function create_tips(TipsRequest $request){


            $answers = $request->answers;

            $question_ids = [];

        try {


            foreach ($answers as $answer){

                if($answer['status']==1){
                    $question_ids [] = $answer['question_id'];

                }

            }

            $questions = Question::whereIn('id',$question_ids)->get();

            $tip_ids = [];
            foreach ($questions as $question){
                $tip_ids [] = $question->tips[0]->id;


            }


            foreach ($tip_ids as $tip_id){
                foreach ($answers as $answer){

                    Result::create([
                        'user_id'=>Auth::guard('api')->id(),
                        'question_id'=>$answer['question_id'],
                        'tip_id'=>$tip_id,
                        'status'=>$answer['status']

                    ]);

                }
            }



            return $this->responseJson(null,'تم حفظ البيانات بنجاح',true);


        }

        catch (\Exception $e){

            return $this->responseJson($e->getMessage(),'حدث خطاء ما',false);
        }




    }


    public function get_tips_by_question(){




//        $question_ids = Result::where('user_id',Auth::guard('api')->id())
//            ->where('status',1)->pluck('question_id');

        $tip_ids = Result::where('user_id',Auth::guard('api')->id())
           ->pluck('tip_id');

        $tips = Tips::with(['questions'=>function($q){
            return $q->select('age_stage');
        }])->whereIn('id',$tip_ids)->get();


//        $tips = Tips::with(['questions'=>function($q){
//            return $q->select('age_stage');
//        }])->whereHas('questions',function ($q) use ($question_ids){
//
//            return $q->whereIn('questions.id',$question_ids);
//
//        })->get();




        $tips = TipsResource::collection($tips);

        return $this->responseJson($tips,null,true);


    }


    public function selected_questions($tip_id){


        $user_questions_results = Result::with(['questions'=>function($q){

            return $q->with('subject');
        }])
            ->where('user_id',Auth::guard('api')->id())
            ->where('tip_id',$tip_id)->get();



        if (isset($user_questions_results) && $user_questions_results->count() > 0)
        {


            $questions = QuestionSelectedResource::collection($user_questions_results);

            return $this->responseJson($questions,null,true);
        }

        return $this->responseJson($user_questions_results,'لا يوجد اسئلة خاصة بهذة الملاحظة',true);



    }

    public function update_tips(updateTipsRequest $request ,$tip_id){


        $answers = $request->answers;

        try {

            $questions_ids = [];
            foreach ($answers as $answer){

                $questions_ids [] = $answer['question_id'];

            }





            $count_items = count($answers);
            for($i = 0; $i<$count_items; $i++)
            {

                $result = Result::where('question_id',$questions_ids[$i])
                    ->where('user_id',Auth::guard('api')->id())
                    ->where('tip_id',$tip_id)
                    ->first();

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
