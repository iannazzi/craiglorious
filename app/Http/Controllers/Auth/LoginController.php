<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Craiglorious\System;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;


use DB, Auth, Session, Redirect;
use Cookie;


class LoginController extends Controller
{
    use ThrottlesLogins;

    protected $redirectTo = '/dashboard';
    protected $redirectAfterLogout = '/auth/login';


    public function checkSession()
    {
        Session::put('last_accessed', time());
        return \Response::json(['guest' => Auth::guest()]);
    }

    public function getLogin()
    {
        return view('pages.auth.login');
    }

    public function postLogin(Request $request)
    {

        $this->validate($request, [
            'company' => 'required', 'username' => 'required', 'password' => 'required',
        ]);

        $company = $request->only('company');
        $credentials = $request->only('username', 'password');
        Cookie::queue(Cookie::forever('company', $company['company']));

        $system = System::where('company', '=', $company['company'])->first();
        if ( ! $system)
        {

            return redirect($this->loginPath())
                ->withInput($request->only($company['company'], 'remember'))
                ->withErrors([
                    $company['company'] => $this->getFailedLoginMessage(),
                ]);
        }

        $system->createTenantConnection();
        Session::put('system', $system->id);

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password'], 'active' => 1]))
        {

            return $this->handleUserWasAuthenticated($request);
        }


        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    public function loginPath()
    {
        return '/auth/login';
    }


    protected function handleUserWasAuthenticated(Request $request)
    {


        $unique_id = uniqid();
        Session::put('unique_id', $unique_id);
        Cookie::queue(Cookie::forever('unique_id', $unique_id));


        $user = \Auth::user();
        $ip = $request->ip();
        $browser = $request->header('User-Agent');
        $time =  \Carbon\Carbon::now()->toDateTimeString();

        myAuth::logoutUser($user->id);


//        if(! $user->canAccessFromIPAddress())
//        {
//            return redirect($this->loginPath())
//                ->withInput($request->only($this->loginUsername(), 'remember'))
//                ->withErrors([
//                    'Ip address restriction' => 'User cannot access system from current IP address',
//                ]);
//        }
//        if($user->terminalOnlyAccess())
//        {
//            return redirect($this->loginPath())
//                ->withInput($request->only($this->loginUsername(), 'remember'))
//                ->withErrors([
//                    'Terminal access only' => 'User can only access from terminal',
//                ]);
//        }

        Session::put('current_page_accessed', 'dashboard');
        Session::put('last_page_accessed', 'auth/login');
        Session::put('last_accessed', time());


        //log the user ip address, browser, etc
        \DB::insert('insert into users_logged_in (user_id, last_accessed, url, ip_address, http_user_agent, unique_id) values (?, ?, ?, ?, ?,?)', [$user->id, $time, 'dashboard', $ip, $browser, $unique_id]);



        return redirect()->intended('dashboard');
    }




}
