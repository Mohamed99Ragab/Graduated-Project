<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $type = explode("\\",$this->type)[2];
        if($type == 'MedicationReminderNotification'){

            $type = 'الادوية';
            }
            elseif ($type == 'VaccinationReminderNotification'){

                $type = 'التطعيمات';
            }
        elseif ($type == 'TeethReminderNotification'){

            $type = 'الاسنان';
        }


        return [


            'title'=>$this->data['title'],
            'body'=>$this->data['body'],
            'created_at'=>date_format($this->created_at,'d/m/Y h:i:s'),
            'type'=>$type



        ];
    }
}
