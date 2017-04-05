<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Craiglorious\System;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use DB, Auth, Session, Redirect;
use Cookie;

use App\Classes\Auth\myAuth;

class LoginController extends Controller
{
//    use ThrottlesLogins;

//    protected $redirectTo = '/dashboard';
//    protected $redirectAfterLogout = '/auth/login';

    public function postLogin(Request $request){

        $myAuth = new myAuth();
        return $myAuth->checkLoginReturnToken($request);


    }
    public function validateToken(Request $request){
        //a token has been sent for user validation....
        $myAuth = new myAuth();
        if($myAuth->checkUserIsAuthenticated($request)){




        }

    }






    //every thing below this is pure nonsense

//
//
//    public function jwtAuthenticate(Request $request)
//    {
//
//
//    }
//
//    public function checkSession()
//    {
//        Session::put('last_accessed', time());
//        return \Response::json(['guest' => Auth::guest()]);
//    }
//
//
//
//    public function authenticatedUser(Request $request)
//    {
////        die(var_dump($request->header()));
////        $token = JWTAuth::getToken();
////        dd('token' . $token);
//        try {
//            if (!$user = JWTAuth::parseToken()->authenticate()) {
//                return response()->json(['user_not_found'], 404);
//            }
//        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
//            return response()->json(['token_expired'], $e->getStatusCode());
//        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
//            return response()->json(['token_invalid'], $e->getStatusCode());
//        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
//            return response()->json(['token_absent'], $e->getStatusCode());
//        }
//        // the token is valid and we have found the user via the sub claim
//        return response()->json(compact('user'));
//    }
//    public function validateToken(Request $request)
//    {
//        $payload = JWTAuth::parseToken()->getPayload();
//        $system = System::where('company', '=', $payload['company'])->first();
//        if(!$system)
//        {
//            return response()->json(['error' => 'invalid_credentials'], 401);
//        }
//        $system->createTenantConnection();
//        $user =JWTAuth::parseToken()->authenticate();
//        //dd($user);
//        //todo: logout user if they log in elsewhere check the database to see if the user has logged in elsewhere....
//        return $user;
//    }
//
//    public function jwtTest(Request $request){
//
//
//        $token = JWTAuth::getToken();
//        echo 'token: ' . $token; //no token
//
//        JWTAuth::setRequest($request);
//        echo 'token: ' . $token; //no token
//
//        $header_token = $request->header('Authorization');
//        $form_token = $request->token;
//
//        JWTAuth::setToken($header_token);
//
//        $token = JWTAuth::getToken();
//        echo 'token: ' . $token; //works for both header and form;
//    }
//
//
//
//    //older stuff
//    public function getLogin()
//    {
//        return view('pages.auth.login');
//    }
//
//    public function postLogin(Request $request)
//    {
//
//        $this->validate($request, [
//            'company' => 'required', 'username' => 'required', 'password' => 'required',
//        ]);
//
//        $company = $request->only('company');
//        $credentials = $request->only('username', 'password');
//        Cookie::queue(Cookie::forever('company', $company['company']));
//
//        $system = System::where('company', '=', $company['company'])->first();
//        if ( ! $system)
//        {
//
//            return redirect($this->loginPath())
//                ->withInput($request->only($company['company'], 'remember'))
//                ->withErrors([
//                    $company['company'] => $this->getFailedLoginMessage(),
//                ]);
//        }
//
//        $system->createTenantConnection();
//        Session::put('system', $system->id);
//
//        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password'], 'active' => 1]))
//        {
//
//            return $this->handleUserWasAuthenticated($request);
//        }
//
//
//        return redirect($this->loginPath())
//            ->withInput($request->only($this->loginUsername(), 'remember'))
//            ->withErrors([
//                $this->loginUsername() => $this->getFailedLoginMessage(),
//            ]);
//    }
//
//    public function loginPath()
//    {
//        return '/auth/login';
//    }
//
//    protected function handleUserWasAuthenticated(Request $request)
//    {
//
//
//
////        Session::put('unique_id', $unique_id);
////        Cookie::queue(Cookie::forever('unique_id', $unique_id));
//
//
//        //myAuth::logoutUserFromOtherClients($user->id);
//
//
////        if(! $user->canAccessFromIPAddress())
////        {
////            return redirect($this->loginPath())
////                ->withInput($request->only($this->loginUsername(), 'remember'))
////                ->withErrors([
////                    'Ip address restriction' => 'User cannot access system from current IP address',
////                ]);
////        }
////        if($user->terminalOnlyAccess())
////        {
////            return redirect($this->loginPath())
////                ->withInput($request->only($this->loginUsername(), 'remember'))
////                ->withErrors([
////                    'Terminal access only' => 'User can only access from terminal',
////                ]);
////        }
//
////        Session::put('current_page_accessed', 'dashboard');
////        Session::put('last_page_accessed', 'auth/login');
////        Session::put('last_accessed', time());
//
//
//
//        return redirect()->intended('dashboard');
//    }
//
//
//
//
}
