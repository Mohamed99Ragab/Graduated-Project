<?php

namespace App\Http\Resources;

use App\Http\Traits\ChildTrait;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class SigleVaccinationResource extends JsonResource
{

    use ChildTrait;


    public function toArray($request)
    {
        $user_vac = [];
        foreach ($this->users as $user_vaccine){
            $user_vac [] = $user_vaccine->pivot->vaccination_id;
        }

        //  calc proposed vaccine date
        $proposed_vaccination_date = date_format(Carbon::now()->addMonths($this->vaccine_age),'Y-m-d');

        //calc age of user in months
        $user = User::find(Auth::guard('api')->id());
        $birth_date = $user->birth_date;
        $date_now = date_format(Carbon::now(),'Y-m-d');

        $ages = $this->calc_child_age($birth_date,$date_now);

        // calc vaccine date
        if($this->vaccine_age ==$ages['months'])
        {
            $this->vaccination_date = $date_now;

        }
        elseif ($this->vaccine_age > $ages['months'])
        {
            $this->vaccination_date = date_format(Carbon::parse($birth_date)->addMonths($this->vaccine_age - $ages['months']),'Y-m-d');

        }
        elseif ($this->vaccine_age < $ages['months'])
        {
            $this->vaccination_date = 'لقد فاتك معاد التطعيم';

        }




        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'vaccine_age'=>$this->vaccine_age,
            'disease_prevention'=>$this->disease_prevention,
            'about'=>$this->about,
            'side_effects'=>$this->side_effects,
            'number_syringe'=>$this->number_syringe,
            'status'=>!empty($user_vac) ? 1 :0,
            'important'=>$this->important,
            'proposed_vaccination_date'=>$proposed_vaccination_date,
            'vaccination_date'=>$this->vaccination_date,

        ];
    }

}
