<?php

namespace App\Http\Traits;





use Illuminate\Http\Request;

trait FilesManagement
{

    public function uploadImage($image,$path,$driver){

        if($image) {

            $image->store($path, $driver);
        }
    }


}
