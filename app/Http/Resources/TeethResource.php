<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeethResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'id'=>$this->id,
            'teeth'=>$this->teeth->name,
            'apperance_date'=>$this->apperance_date,
            'age_in_months'=>$this->age_in_months,
            'age_in_years'=>$this->age_in_years,

        ];
    }
}
