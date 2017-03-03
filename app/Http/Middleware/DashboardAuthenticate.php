<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\myAuth;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class DashboardAuthenticate
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

       //is the user restricted to a terminal?
        //is the user restricted to an ip



        //does the user have access to the route?
        $user = $this->auth->user();
        $views = $user->views();
        $ok = false;
        $route = $request->route()->uri();

        if($route =='dashboard'
            || $route == 'user')
        {
            return $next($request);
        }
        //now check role routes
        foreach($views as $view)
        {
            if (strpos($route, $view->route) !== false) {
                if($view->access !='none')
                {
                    $ok = true;
                    break;
                }
            }
        }

        if(! $ok){
            //dd($route);
            return \Redirect::to('auth/logout');
        }

        return $next($request);
    }
}