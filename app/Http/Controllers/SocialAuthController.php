<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function google_redirect(){



        return Socialite::driver('google')->redirect();
    }

    public function google_callback(){


        $user = Socialite::driver('google')->user();
       dd($user);

        $user_db = User::where('email',$user->email)->first();
        if($user_db == null){
            $user_db =  User::create([
                'name'=>$user->name,
                'avatar'=>$user->avatar,
                'email'=>$user->email,
                'password'=>Hash::make('123456'),
                'OAth_Token' => $user->token
            ]);

            Auth::login($user_db);
            return redirect(route('home'));
        }
        else{
            Auth::login($user_db);
            return redirect(route('home'));
        }

    }

}
