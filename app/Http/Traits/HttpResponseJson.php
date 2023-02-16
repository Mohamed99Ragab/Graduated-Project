<?php

namespace App\Http\Traits;

trait HttpResponseJson
{

    public function responseJson($data =null,$message = null,$status = null){


        return response()->json(['data'=>$data,'message'=>$message,'status'=>$status]);
    }
}
