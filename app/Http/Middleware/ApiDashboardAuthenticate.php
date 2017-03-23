<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\myAuth;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiDashboardAuthenticate
{
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = false;
        if($request->headers->get('authorization'))
        {
            $token = $request->headers->get('authorization');
        }
        else if(isset($request->token) )
        {
            $token = $request->token;
        }
        if($token == false){
            return $this->respond('tymon.jwt.absent', 'token_not_provided', 400);
        }

        JWTAuth::setToken($token);


        return $next($request);

    }
}