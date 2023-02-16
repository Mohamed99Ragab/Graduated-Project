<?php

namespace App\Http\Traits;

use Carbon\Carbon;

trait ChildTrait
{

    public function calc_child_age($start_date , $end_date){

        $start = Carbon::parse($start_date);
        $end = Carbon::parse($end_date);

        $age_in_years = $start->diffInYears($end);
        $age_in_months = $start->diffInMonths($end);
        $age_in_days = $start->diffInDays($end);

        $ages = [
            'years'=>$age_in_years,
            'months'=>$age_in_months,
            'days'=>$age_in_days
        ];

        return $ages;

    }



}
