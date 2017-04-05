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

class RoleMiddleware
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
        $route = $request->route()->uri();
        $route = str_replace('/api/', '', $route);
        //a few routes have special features....

        //check route access here....
        //does the user have access to the route?
        $views = \Config::get('user')->views();
        $ok = false;

        //now check user accessable routes
        foreach ($views as $view)
        {
            if (strpos($route, $view->route) !== false)
            {
                if ($view->access != 'none')
                {
                    $ok = true;
                    break;
                }
            }
        }

        if ( ! $ok)
        {
            return response()->json(['error' => 'Why are you trying to access this route? Admins have been informed.'], 401);
        }

        $myAuth = new myAuth();
        $myAuth->logAuthUserActivity($request);

        return $next($request);
    }

}
