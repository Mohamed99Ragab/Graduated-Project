<?php

namespace App\Http\Traits;





use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait FilesManagement
{

    public function uploadImage($image,$path,$driver){

        if($image) {

            $image->store($path, $driver);
        }
    }

    public function removeImage($image,$driver,$path,$img_db){

        if($image) {

            Storage::disk($driver)->delete("$path/".$img_db);
        }
    }


}
