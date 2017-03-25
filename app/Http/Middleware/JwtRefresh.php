<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Auth\myAuth;
use Tymon\JWTAuth\Facades\JWTAuth;



class JwtRefresh
{
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    public function handle($request, Closure $next)
    {


        $response = $next($request);

        //$token = JWTAuth::setRequest($request)->getToken();

        $newToken = JWTAuth::setRequest($request)->parseToken()->refresh();
        dd($newToken);

//
//        try {
//            $newToken = $this->auth->setRequest($request)->parseToken()->refresh();
//        } catch (TokenExpiredException $e) {
//            return $this->respond('tymon.jwt.expired', 'token_expired', $e->getStatusCode(), [$e]);
//        } catch (JWTException $e) {
//            return $this->respond('tymon.jwt.invalid', 'token_invalid', $e->getStatusCode(), [$e]);
//        }

        // send the refreshed token back to the client
        $response->headers->set('Authorization', 'Bearer '.$newToken);

        return $response;

    }
}