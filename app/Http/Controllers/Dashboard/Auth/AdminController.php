<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\FilesManagement;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    use FilesManagement;

    public function login (Request $request){

        $request->validate([
            'email'=>'required|exists:admins,email|email',
            'password'=>'required|string'
        ]);


        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){

            $admin = Admin::where('email',$request->email)->first();

            Auth::guard('admin')->login($admin);

            session()->flash('success','تم تسجيل الدخول بنجاح');
            return redirect()->route('dashboard');
        }

        session()->flash('error','خطا في بيانات الدخول');
        return back();

    }




    public function edit_profile(){

           $admin =  Admin::findOrfail(Auth::guard('admin')->id());

           return view('dashboard.admins.update_profile',compact('admin'));
    }


    public function update_profile(Request $request){

        $admin = Admin::findOrfail($request->admin_id);

        if(isset($admin)){

            $admin->username = $request->username;
            $admin->email = $request->email;
            if($request->password){
                $admin->password = Hash::make($request->password);
            }

            if($request->file('photo')){
                //delete last image from server
                Storage::disk('images')->delete('admins/'.$admin->photo);

                //upload new photo on server
                $this->uploadImage($request->file('photo'),'admins','images');

                //save image in db
                $admin->photo = $request->file('photo')->hashName();


            }
            $admin->save();

//            toastr()->success('تم تحديث البروفيل');
            session()->flash('success','تم تحديث البروفيل');
            return redirect('/home');



        }

    }










    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
