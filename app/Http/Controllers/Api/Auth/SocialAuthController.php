<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest\LoginByGoogleFacebookRequest;
use App\Http\Resources\UserAuth;
use App\Http\Traits\HttpResponseJson;
use App\Models\DeviceToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    use HttpResponseJson;

    private $token;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['token']]);


    }




    public function token(LoginByGoogleFacebookRequest $request)
    {

        if (isset($request->validator) && $request->validator->fails()) {

            return $this->responseJson(null,$request->validator->messages(),false);


        }


        try {
            // authenticate the token against the provider
            $user = Socialite::driver($request->provider)->stateless()->userFromToken($request->oauth_token);



            // find or create an authenticated user
            if (!$authenticatedUser = User::where('provider_id', $user->id)->first()) {
                $authenticatedUser = User::create([
                    'email' => $user->email,
                    'name' => $user->name,
                    'photo'=>'Sleeping_on_the_moon.jpg',
                    'birth_date'=>null,
                    'gender'=>null,
                    'password'=>null,
                    'provider' => $request->provider,
                    'provider_id' => $user->id,
                    'oauth_token' => $user->token
                ]);
            }

            // login the user & get an access token for the API
            $this->token = auth()->guard('api')->login($authenticatedUser);

            // add devive token to user
            DeviceToken::updateOrCreate(
                ['token' => $request->fcm_token],
                ['user_id' => Auth::guard('api')->id()]
            );


            // respond with the access token
            return $this->respondWithToken($this->token,$authenticatedUser);
        }
        catch (\Exception $e){

            return $this->responseJson(null,'oauth token غير صحيح',false);

        }







    }


    public function respondWithToken($token,$user)
    {

        return $this->responseJson([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user'=>new UserAuth(auth()->user())
        ],null,true);

    }
}
