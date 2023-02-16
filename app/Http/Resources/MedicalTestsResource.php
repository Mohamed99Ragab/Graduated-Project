<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicalTestsResource extends JsonResource
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
            'lab_name'=>$this->lab_name,
            'type'=>$this->type,
            'lab_date'=>$this->lab_date,
            'lab_file'=>asset('images/tests/'.$this->lab_file),
        ];
    }
}
