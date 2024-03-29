<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAuth extends JsonResource
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
            'name'=>$this->name,
            'email'=>$this->email,
            'phone_number'=>$this->phone_number,
            'gender'=>$this->gender,
            'birth_date'=>$this->birth_date,
            'is_reminder_vaccine'=>$this->is_reminder_vaccine,
            'photo'=> $this->photo !=null ? asset('images/users/'.$this->photo) : null
        ];

    }
}
