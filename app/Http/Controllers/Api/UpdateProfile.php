<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\FilesManagement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UpdateProfile extends Controller
{

    use FilesManagement;
    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users,email,'.$id,
            'photo' =>'mimes:jpg,png|image',
            'gender'=>'required|string|in:ذكر,انثى',
            'birth_date'=>'required|date',
            'password' => 'string|min:6',
        ]);


        $user = User::find($id);

       if($user !=null){

           // romove last photo
           if($request->hasFile('photo')){
               Storage::disk('images')->delete('users/'.$user->photo);
           }

           $user->update([
               'name'=> $request->name,
               'email'=>$request->email,
               'gender'=>$request->gender,
               'birth_date'=>$request->birth_date,
               //save image path in database with check if request file
               'photo'=>$request->file('photo') ? $request->file('photo')->hashName():null
           ]);

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
