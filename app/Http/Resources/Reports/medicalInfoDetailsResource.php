<?php

namespace App\Http\Resources\Reports;

use App\Http\Traits\ChildTrait;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class medicalInfoDetailsResource extends JsonResource
{
    use ChildTrait;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $userAge = $this->calc_child_age($this->user->birth_date,date_format(Carbon::now(),'Y-m-d'));


        return [
            'username'=>$this->user->name,
            'userAgeInMonth'=>$userAge['months'],
            'blood_type'=>$this->blood_type,
            'allergy'=>$this->allergy,
            'skin_disease'=>$this->skin_disease,
            'chronic_disease'=>$this->chronic_disease,
            'genetic_disease'=>$this->genetic_disease,
            'Is_medicine'=>$this->Is_medicine,
            'medicine_file'=>$this->medicine_file


        ];
    }
}
