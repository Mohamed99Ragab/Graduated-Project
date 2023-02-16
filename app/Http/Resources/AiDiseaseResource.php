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
            'prediction' => $this->prediction,
            'created_at' => date_format($this->created_at,'Y-m-d'),
            'photo' => asset('images/diseases/' . $this->disease_photo),
        ];
    }


}
