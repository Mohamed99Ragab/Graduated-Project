<?php

namespace App\Http\Middleware;

use App\Http\Traits\HttpResponseJson;
use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use Exception;

class JwtMiddleware
{
    use HttpResponseJson;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this->responseJson(null,'توكن غير صحيح',false);

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->responseJson(null,'انتهت صلاحية التوكن',false);
            }else{
                return $this->responseJson(null,'يجب تسجيل الدخول اولا',false);
            }
        }
        return $next($request);
    }
}
