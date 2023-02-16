<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest\LoginReguest;
use App\Http\Requests\AuthRequest\RegisterReguest;
use App\Http\Resources\UserAuth;
use App\Http\Traits\FilesManagement;
use App\Models\DeviceToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    use FilesManagement;
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(LoginReguest $request){




        if (! $token = auth()->attempt(['email'=>$request->email,'password'=>$request->password])) {
            return response()->json(['error' => 'خطاء في بيانات الدخول'], 401);
        }

        // add devive token to user
        DeviceToken::updateOrCreate(
            ['token' => $request->fcm_token],
            ['user_id' => Auth::guard('api')->id()]
        );


        return $this->createNewToken($token);
    }


    public function register(RegisterReguest $request) {


        $user = User::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'birth_date'=>$request->birth_date,
            'password'=>Hash::make($request->password),

            //save image path in database with check if request file
            'photo'=>$request->file('photo') ? $request->file('photo')->hashName():null
            ]);

        //to upload photo on server
        $this->uploadImage($request->file('photo'),'users','images');



        if (! $token = auth()->attempt(['email'=>$request->email,'password'=>$request->password])) {
            return response()->json(['error' => 'خطاء في عملية الدخول'], 401);
        }

        // add devive token to user
        DeviceToken::create([
            'token' => $request->fcm_token,
            'user_id' => Auth::guard('api')->id()
        ]);

        return $this->createNewToken($token);

    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'تم تسجيل الخروج بنجاح']);
    }

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function userProfile() {
        return response()->json(['data'=>auth()->user()],200);
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => new UserAuth(auth()->user())
        ]);
    }
}
