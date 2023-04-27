<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AiDiseaseResource extends JsonResource
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
            'id' => $this->id,
            'disease' => $this->disease_name,
            'prediction' => $this->prediction ==1 ? 'مصاب':'غير مصاب',
            'created_at' => date_format($this->created_at,'d/m/Y'),
            'photo' => asset('public/images/diseases/' . $this->disease_photo),
        ];
    }


}
