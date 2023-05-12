<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        elseif ($type == 'DevelopmentFollowNotification'){

            $type = 'التطور';
        }

        elseif ($type == 'growthNotification'){

            $type = 'النمو';
        }


        return [


            'title'=>$this->data['title'],
            'body'=>$this->data['body'],
            'created_at'=>date_format(Carbon::parse($this->created_at)->addHour(),'d/m/Y g:i a'),
            'type'=>$type



        ];
    }
}
