<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserVaccinationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $user_vac = [];
        foreach ($this->users as $user_vaccine){
            $user_vac [] = $user_vaccine->pivot->vaccination_id;
        }


        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'vaccine_age'=>$this->vaccine_age,
            'prevention'=>$this->disease_prevention,
            'status'=>!empty($user_vac) ? 1 :0,


        ];
    }
}
