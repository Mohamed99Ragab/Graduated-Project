<?php

namespace App\Http\Resources;

use App\Http\Traits\ChildTrait;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserVaccinationResource extends JsonResource
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

        $user_vac = [];
        foreach ($this->users as $user_vaccine){
            $user_vac [] = $user_vaccine->pivot->vaccination_id;
        }





        $proposed_vaccination_date = date_format(Carbon::now()->addMonths($this->vaccine_age),'Y-m-d');





        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'vaccine_age'=>$this->vaccine_age,
            'prevention'=>$this->disease_prevention,
            'status'=>!empty($user_vac) ? 1 :0,
            'important'=>$this->important,
            'proposed_vaccination_date'=>$proposed_vaccination_date

        ];
    }
}
