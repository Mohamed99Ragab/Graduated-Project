<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    private $provider;
    private $access_token;
    private $token;

    public function __construct(Request $request)
    {
        $this->middleware('auth:api', ['except' => ['token']]);


        $this->provider = ($request->has('provider') ? $request->get('provider') : false);
        $this->access_token = ($request->has('access_token') ? $request->get('access_token') : false);
    }

    /**
     * Exchanges an access_token from identity providers for an access_token to be used to authenticate the api.jwt auth guard
     * @return \Illuminate\Http\JsonResponse
     */



    public function token(Request $request)
    {
        $request->validate([
            'access_token'=>'required|string',
            'provider'=>'required|string|in:google,facebook'
        ]);


        // authenticate the token against the provider
        $user = Socialite::driver($this->provider)->stateless()->userFromToken($this->access_token);
//        dd($user);
        // find or create an authenticated user
        if (!$authenticatedUser = User::where('email', $user->email)->first()) {
            $authenticatedUser = User::create([
                'email' => $user->email,
                'name' => $this->provider=='google'?$user->name : $user->nickname,
                'photo'=>null,
                'birth_date'=>null,
                'gender'=>null,
                'password'=>null,
                'provider' => $this->provider,
                'oauth_token' => $user->token
            ]);
        }

        // login the user & get an access token for the API
        $this->token = auth()->guard('api')->login($authenticatedUser);

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
