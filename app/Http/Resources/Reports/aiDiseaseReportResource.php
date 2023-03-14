<?php

namespace App\Http\Resources\Reports;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class aiDiseaseReportResource extends JsonResource
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
            'disease'=>$this->disease_name,
            'created_at'=>date_format($this->created_at,'d/m/Y')
        ];
    }
}
