<?php

namespace App\Http\Resources;

use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class TipsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $age_stages = [];
        foreach ($this->questions as $question){
            $age_stages[] = $question->age_stage;
        }




            $result = Result::where('tip_id',$this->id)
                ->where('user_id',Auth::guard('api')->id())
                ->where('status',0)->pluck('question_id');

            $qusionts_unanswered = Question::select('question')->whereIn('id',$result)->get();



        $result_tip_created_date = Result::where('tip_id',$this->id)
            ->where('user_id',Auth::guard('api')->id())->first();



        return [
            'id'=>$this->id,
            'description'=>$this->description,
            'age_stage'=>$age_stages[0],
            'date'=>$result_tip_created_date->created_at,
            'unAnswerQuestions'=>$qusionts_unanswered

        ];
    }
}
