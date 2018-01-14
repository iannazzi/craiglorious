<?php

namespace App\Http\Controllers\Auth;

use App\Models\Tenant\User;

use App\Models\Craiglorious\System;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Http\Request;
use App\Classes\Auth\myAuth;
use App\Classes\Auth\myJwt;

class AccessController extends Controller
{

    //middle ware - check user has route access
    //terminal check user is authenticated (every x seconds)

    public function checkUserIsAuthenticated(Request $request)
    {
       //we do not want to send a new token down on this request...
        //this is checking to see if the user is still logged in....
        //user can be kicked out at any time by logging onto a different computer

        //even if we set timers on the client to log out a user the client would not know
        //about other clients, so we have to continually check......

        //at this point, we made it through middle ware so we are all set.....
//        $myAuth = new myAuth();
//        $myJwt = new myJwt();
//        $token = $myAuth->getTokenFromRequest($request);
//
//        $user =  \Config::get('user');

        return response()->json([
            //'user' => $user,
            //'token' => $token,
            'success' => true,
        ], 200);

    }

    public function pageRefresh(Request $request){
        //at this point, we made it through middle ware so we are all set.....
//        $myAuth = new myAuth();
//        $myJwt = new myJwt();
//        $token = $myAuth->getTokenFromRequest($request);
//
        $user =  \Config::get('user');

        return response()->json([
            'user' => $user,
            //'token' => $token,
            'success' => true,
        ], 200);
    }
    public function craigSocket(Request $request){

        //craig socket is a little different than verify
        //we call craig socket after user activity occurs
        //we will refresh the token and send down a new one along with other data

        //seeing that the user is still active, give them a new token
        //which has a nice new expiration data
        //what is the current unique id?
        $myAuth = new myAuth();
        $myJwt = new myJwt();
        $token = $myAuth->getTokenFromRequest($request);
        $token_data = $myJwt->validateFirebaseToken($token);
        $unique_id = $token_data->data->unique_id;

        $user =  \Config::get('user');
        $company =  \Config::get('company');
        $myJwt = new myJwt();
        $token = $myJwt->createFirebaseToken($user, $company, $unique_id);

        //add in any other information the user might want to know about

        return response()->json([
            'user' => $user,
            'token' => $token,
            'messages' => 'hi',
            'success' => true,
        ], 200);
    }

    public function jwtdecode(Request $request){
        $token = $myAuth->getTokenFromRequest($request);
        $token_data = $myJwt->validateFirebaseToken($token);
    }
    public function userid(Request $request){
        return response()->json([
            'user' => \Config::get('user'),
            'messages' => 'did you get the id',
            'success' => true,
        ], 200);
    }

}
