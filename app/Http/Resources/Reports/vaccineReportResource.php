<?php

namespace App\Http\Resources\Reports;

use Illuminate\Http\Resources\Json\JsonResource;

class vaccineReportResource extends JsonResource
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

            'name'=>$this->name,
            'prevention'=>$this->disease_prevention,
            'status'=>1,
        ];
    }
}
