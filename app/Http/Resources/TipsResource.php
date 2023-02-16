<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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

        return [
            'id'=>$this->id,
            'description'=>$this->description,
            'age_stage'=>$age_stages[0],

        ];
    }
}
