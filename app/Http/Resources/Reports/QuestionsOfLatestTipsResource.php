<?php

namespace App\Http\Resources\Reports;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionsOfLatestTipsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $questions = [];
        foreach ($this->questions as $question){

            $questions [] = $question->question;
        }



        return [

            'questions'=>$questions

        ];
    }
}
