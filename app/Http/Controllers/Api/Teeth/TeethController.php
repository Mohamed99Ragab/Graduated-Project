<?php

namespace App\Http\Controllers\Api\Teeth;

use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponseJson;
use App\Models\Teeth;
use Illuminate\Http\Request;

class TeethController extends Controller
{

    use  HttpResponseJson;

    public function get_all_teeths(){

        $teeths = Teeth::select('id','name')->get();

        if(isset($teeths) && $teeths->count() > 0){

            return $this->responseJson($teeths,null,true);
        }

        return $this->responseJson($teeths,'لم يتم اضافة الاسنان الطبية حتى الان',true);



    }



}
