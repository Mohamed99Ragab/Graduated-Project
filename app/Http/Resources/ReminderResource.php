<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReminderResource extends JsonResource
{

    public function toArray($request)
    {


        $days =[];
        foreach ($this->medcineTimes as $time){

            $days [] = $time->medicinedays;

            foreach ($days as $day){

                $day_ids = [];
                foreach ($day as $item){

                    $day_ids [] = [
                      'id'=>$item->id,
                        'day'=>$item->day,
                    ];
                }
            }

        }

        $times = [];
        $month =[];
        foreach ($this->medcineTimes as $time){



            $times []= [
                'id'=>$time->id,
                'time'=>date_format(Carbon::parse($time->time),'g:i a'),
                'month'=>$time->month,
            ];

        }


        return [

             'id'=>$this->id,
            'medicine_name'=>$this->medicine_name,
            'appointment'=>$this->appointment,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'times'=>$times,
            'days'=>(!empty($day_ids) ? $day_ids : null),

        ];
    }
}
