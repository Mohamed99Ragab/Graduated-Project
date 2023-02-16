<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest\UpdateProfileRequest;
use App\Http\Traits\FilesManagement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UpdateProfile extends Controller
{

    use FilesManagement;
    public function update(UpdateProfileRequest $request){


       


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

           return response()->json(['message'=>'تم التعديل بنجاح'],200);

       }
       else{

           return response()->json(['message'=>'يجب تسجيل الدخول اولا']);

       }


    }
}
