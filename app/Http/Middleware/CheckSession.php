<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Auth\myAuth;


class CheckSession
{
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    public function handle($request, Closure $next)
    {
        //basically we will go to the dashboard if
        //we are already logged in and hit
        // login

        if(session()->has('system') )
        {
            if(myAuth::myCheck($request))
            {

            }
        }
        return $next($request);
    }
}