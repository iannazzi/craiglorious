<?php

namespace App\Http\Controllers\Auth;
use App\Models\Tenant\User;

use App\Models\Craiglorious\System;
use App\Http\Controllers\Controller;

use DB;
use \Hash;
use Illuminate\Http\Request;

use App\Classes\Auth\myAuth;
use App\Classes\Auth\myJwt;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        $myAuth = new myAuth();
        $myJwt = new myJwt();

        $username = $request->username;
        $password = $request->password;
        $company = $request->company;

        if ( ! $system = System::where('company', $company)->first())
        {
            return response()->json(['error' => 'could not validate system'], 401);
        }
        $system->createTenantConnection();

        if ( ! $user = User::where('username', $username)->first())
        {
            return response()->json(['error' => 'could not validate user'], 401);
        }

        if (Hash::check($password, $user->password))
        {
            //i think that we will never need these as we are immediately
            //returning a response
//            \Config::set('user', $user);
//            \Config::set('tenant_system', $system);

            $myAuth->user = $user;

            //this allow only one login on one browser
            $unique_id = uniqid();
            $myAuth->addUserLoginToDb($request, $unique_id);

            $token = $myJwt->createFirebaseToken($user, $company, $unique_id);
            return response()->json(compact('user', 'token'));

        }

        return response()->json(['error' => 'could not validate user'], 401);




    }
}
