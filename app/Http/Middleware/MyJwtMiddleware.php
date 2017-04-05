<?php
/**
 * Created by PhpStorm.
 * User: embrasse-moi
 * Date: 11/25/16
 * Time: 9:44 PM
 */

namespace App\Http\Middleware;


use App\Models\Craiglorious\System;
use App\Classes\Auth\myAuth;

class MyJwtMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {

        $myAuth = new myAuth();

        if($myAuth->checkUserIsAuthenticated($request)){

            //check route access here....
            $myAuth->checkUserRouteAccess($request);

            $myAuth->logAuthUserActivity($request);

            return $next($request);
        }




    }
}
