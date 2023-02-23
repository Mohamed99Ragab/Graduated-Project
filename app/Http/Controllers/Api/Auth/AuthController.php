<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest\LoginReguest;
use App\Http\Requests\AuthRequest\RegisterReguest;
use App\Http\Resources\UserAuth;
use App\Http\Traits\FilesManagement;
use App\Http\Traits\HttpResponseJson;
use App\Models\DeviceToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;


class AuthController extends Controller
{
    use FilesManagement , HttpResponseJson;
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register','logout']]);
    }

    public function login(LoginReguest $request){

        if (isset($request->validator) && $request->validator->fails()) {

            return $this->responseJson(null,$request->validator->messages(),false);
        }


        if (! $token = auth()->attempt(['email'=>$request->email,'password'=>$request->password])) {

            return $this->responseJson(null,'خطاء في بيانات الدخول',false);
        }

        // add devive token to user
        DeviceToken::updateOrCreate(
            ['token' => $request->fcm_token],
            ['user_id' => Auth::guard('api')->id()]
        );


        return $this->createNewToken($token);
    }


    public function register(RegisterReguest $request) {


        DB::beginTransaction();

        try {

            if (isset($request->validator) && $request->validator->fails()) {

                return $this->responseJson(null,$request->validator->messages(),false);
            }



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

                return $this->responseJson(null,'خطاء في عملية الدخول',false);
            }

            // add devive token to user
            DeviceToken::create([
                'token' => $request->fcm_token,
                'user_id' => Auth::guard('api')->id()
            ]);

            DB::commit();
            return $this->createNewToken($token);


        }

        catch (\Exception $e){

            DB::rollback();
            return $this->responseJson($e->getMessage(),'الرجاء المحاوالة مرة اخرى',false);
        }





    }

    public function logout() {

        if(!empty(Auth::guard('api')->user())){
            auth()->logout();
            return $this->responseJson(null,'تم تسجيل الخروج بنجاح',true);
        }

        return $this->responseJson(null,'يجب تسجيل الدخول اولا لتمكن من تسجيل الخروج',false);

    }

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function userProfile() {
        return response()->json(['data'=>auth()->user()],200);
    }

    protected function createNewToken($token){


        return $this->responseJson([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => new UserAuth(auth()->user())
        ],null,true);


    }
}
