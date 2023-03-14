<?php

namespace App\Http\Resources\Reports;

use Illuminate\Http\Resources\Json\JsonResource;

class TeethReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        if($this->age_in_months >= $this->teeth->month_start && $this->age_in_months <= $this->teeth->month_end)
        {

            $status='تطور الأسنان عند طفلك طبيعي';
        }else
        {
            $status='تطور الأسنان عند طفلك غير طبيعي';
        }


        return [
            'teeth'=>$this->teeth->name,
            'age_in_months'=>$this->age_in_months,
            'status'=>$status,

        ];
    }
}
