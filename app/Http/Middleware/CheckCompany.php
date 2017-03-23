<?php
/**
 * Created by PhpStorm.
 * User: embrasse-moi
 * Date: 11/25/16
 * Time: 9:44 PM
 */

namespace App\Http\Middleware;


//use Tymon\JWTAuth\Exceptions\JWTException;
//use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Craiglorious\System;

class CheckCompany extends BaseMiddleware
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

        $payload = JWTAuth::parseToken()->getPayload();
        $system = System::where('company', '=', $payload['company'])->first();
        if ( ! $system)
        {
            return response()->json(['error' => 'no system'], 401);
        }
        \Config::set('tenant_system', $system);


        $system->createTenantConnection();
        //dd($system->company);
        //dd($token);
        return $next($request);
    }
}
