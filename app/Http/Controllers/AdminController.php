<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login (Request $request){

        $request->validate([
            'email'=>'required|exists:admins,email|email',
            'password'=>'required|string'
        ]);


        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){

            $admin = Admin::where('email',$request->email)->first();

            Auth::guard('admin')->login($admin);

            toastr()->success('تم تسجيل الدخول بنجاح');

            return redirect()->route('dashboard');
        }

        toastr()->error('خطا في بيانات الدخول');
        return back();

    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
