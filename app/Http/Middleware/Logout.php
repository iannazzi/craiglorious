<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\myAuth;


use Closure;
use Illuminate\Contracts\Auth\Guard;

class Logout
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
        if(!(session()->has('system')))
        {
            return \Redirect::to('auth/login');
        }

        //$myAuth = new myAuth($this->auth);

        if(!myAuth::myCheck($request))
        {
            return \Redirect::to('auth/login');
        }

        return $next($request);
    }
}