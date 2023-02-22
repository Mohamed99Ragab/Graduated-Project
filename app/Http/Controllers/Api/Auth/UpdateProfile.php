<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest\UpdateProfileRequest;
use App\Http\Traits\FilesManagement;
use App\Http\Traits\HttpResponseJson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UpdateProfile extends Controller
{

    use FilesManagement , HttpResponseJson;
    public function update(UpdateProfileRequest $request){


        if (isset($request->validator) && $request->validator->fails()) {

            return $this->responseJson(null,$request->validator->messages(),false);

        }


        $user = User::find(Auth::guard('api')->id());

       if(isset($user) & !empty($user)){



           // make update new data
           $user->name = $request->name;
           $user->email = $request->email;
           $user->gender = $request->gender;
           $user->birth_date = $request->birth_date;

           // romove last photo
           if($request->hasFile('photo')){

               Storage::disk('images')->delete('users/'.$user->photo);
               $user->photo = $request->file('photo')->hashName();
           }
           $user->save();



           if(!empty($request->password)){
               $user->update([
                   'password'=>Hash::make($request->password),
               ]);
           }


           //to upload new photo on server
           $this->uploadImage($request->file('photo'),'users','images');

           return $this->responseJson(null,'تم التعديل بنجاح',true);

       }
       else{

           return $this->responseJson(null,'يجب تسجيل الدخول اولا',false);


       }


    }
}
