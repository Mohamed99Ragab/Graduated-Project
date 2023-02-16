<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionSelectedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $arr_tips = [];
        foreach ($this->tips as $tip){

            $arr_tips [] = $tip->id;
        }


        return [
            'id'=>$this->id,
            'question'=>$this->question,
            'subject'=>$this->subject->name,
            'status'=>!empty($arr_tips[0]) ? 1 :0

        ];
    }
}
