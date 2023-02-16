<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserAuth;
use App\Models\DeviceToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    private $provider;
    private $oauth_token;
    private $token;

    public function __construct(Request $request)
    {
        $this->middleware('auth:api', ['except' => ['token']]);


        $this->provider = ($request->has('provider') ? $request->get('provider') : false);
        $this->oauth_token = ($request->has('oauth_token') ? $request->get('oauth_token') : false);
    }

    /**
     * Exchanges an access_token from identity providers for an access_token to be used to authenticate the api.jwt auth guard
     * @return \Illuminate\Http\JsonResponse
     */



    public function token(Request $request)
    {
        $request->validate([
            'oauth_token'=>'required|string',
            'provider'=>'required|string|in:google,facebook',
            'fcm_token'=>'required'
        ]);


        // authenticate the token against the provider
        $user = Socialite::driver($this->provider)->stateless()->userFromToken($this->oauth_token);
//        dd($user);
        // find or create an authenticated user
        if (!$authenticatedUser = User::where('provider_id', $user->id)->first()) {
            $authenticatedUser = User::create([
                'email' => $user->email,
                'name' => $user->name,
                'photo'=>'Sleeping_on_the_moon.jpg',
                'birth_date'=>null,
                'gender'=>null,
                'password'=>null,
                'provider' => $this->provider,
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


    public function respondWithToken($token,$user)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 'todo',
            'user'=>new UserAuth(auth()->user())
        ]);
    }
}
