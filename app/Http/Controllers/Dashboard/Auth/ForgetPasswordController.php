<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RestPasswordWebMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use function Symfony\Component\String\b;

class ForgetPasswordController extends Controller
{



    public function forget_password(){

        return view('dashboard.restPassword.forget_pw');
    }



    public function send_to_email(Request $request){

//        return $request;
        $admin = Admin::where('email',$request->email)->first();

        $token = Str::random(200);
        if($admin){
            $password_reset = DB::table('password_resets')->insert([
                'email'=>$admin->email,
                'token'=>$token
            ]);

            Mail::to($request->email)->send(new RestPasswordWebMail($token));

            session()->flash('success','لقد كمنا بارسال رسالة الى ذالك الايميل');
            return back();
        }


        session()->flash('error','لا يوجد حساب بهذا الايميل');
        return back();



    }


    public function rest_password_form($token){


        $token_str = $token;

        return view('dashboard.restPassword.rest_password',compact('token_str'));

    }

    public function rest_password(Request $request){


        $request->validate([
            'email'=>'required|email',
            'password'=>'required|confirmed',

        ]);


        $admin = Admin::where('email',$request->email)->first();

        if($admin){
            $rest_password = DB::table('password_resets')->where('token',$request->token)->first();

            if($rest_password){
                $admin->update([
                    'password'=>Hash::make($request->password)
                ]);

                DB::table('password_resets')->where('email',$request->email)->delete();

                session()->flash('success','تم تغيير كلمة المرور الخاصة بحسابك');
                return redirect()->route('login');
            }
        }

        session()->flash('error','عذرا لا يمكنك تغيير كلمة مرور حساب شخص اخر');
        return back();


    }


}
