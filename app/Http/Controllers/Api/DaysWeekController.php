<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponseJson;
use App\Models\MedicineDay;
use Illuminate\Http\Request;

class DaysWeekController extends Controller
{

    use HttpResponseJson;
    public function get_days(){


        $days = MedicineDay::all();

        if (isset($days)& $days->count()>0){



            return $this->responseJson($days,null,true);
        }
        return $this->responseJson(null,'لا يوجد ايام اسبوع مسجلة حتى الان',false);
    }
}
