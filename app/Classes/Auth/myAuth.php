<?php namespace App\Classes\Auth;

use App\Classes\Auth\myJwt;
use  App\Models\Craiglorious\System;
use App\Models\Tenant\User;
use Illuminate\Http\Request;
use  Redirect, Session, Log, DB;
use Illuminate\Support\Facades\Auth;
use \DomainException;


class myAuth
{
    protected $myJwt;
    public $user;

    function __construct()
    {
        $this->myJwt = new myJwt();
    }

    public function checkUserIsAuthenticated(Request $request)
    {
        //a token has been sent for user validation....
        $myAuth = new myAuth();
        $myJwt = new myJwt();

        $token = $this->getTokenFromRequest($request);
        if ($token_data = $this->myJwt->validateFirebaseToken($token))
        {
            $company = $token_data->data->company;

            $system = System::where('company', $company)->first();
            if ( ! $system)
            {
                abort(401, 'could not validate system.');
            }
            $system->createTenantConnection();
            \Config::set('tenant_system', $system);

            $id = $token_data->data->user_id;

            $user = User::where('id', $id)
                ->first();

            if ( ! $user)
            {
                abort(401, 'could not validate user.');
            }

            //check the db that the unique id matches the db


            \Config::set('user', $user);
            \Config::set('company', $company);

            $this->user = $user;
            $unique_id = $token_data->data->unique_id;
            if(! $this->checkUniqueIdInDb($user, $unique_id)){
                abort(401, 'Unique Id does not match DB');
            }

            return true;

        }
        abort(401, 'could not validate token.');

    }

    public function getTokenFromRequest(Request $request)
    {
        $authHeader = $request->headers->get('authorization');
        if ($authHeader)
        {
            $token = str_replace('Bearer ', '', $authHeader);
            if ($token)
            {
                return $token;
            }
            abort(401, 'no token present');
        }
        abort(401, 'no auth header');

    }

    public function checkUniqueIdInDb($user, $unique_id)
    {
        $user_logged_in = \DB::select("SELECT user_id FROM users_logged_in WHERE user_id = ? AND unique_id =?", [$user->id, $unique_id]);
        if (sizeof($user_logged_in) == 1)
        {
            return true;
        }
        return false;
    }

    public
    function addUserLoginToDb($request, $unique_id)
    {
        $user = $this->user;
        $this->deleteUserLogin($user);
        $ip = $request->ip();
        $browser = $request->header('User-Agent');
        $time = \Carbon\Carbon::now()->toDateTimeString();
        \DB::insert('insert into users_logged_in (user_id, last_accessed, url, ip_address, http_user_agent, unique_id) values (?, ?, ?, ?, ?,?)', [$user->id, $time, 'dashboard', $ip, $browser, $unique_id]);

    }

    public
    function deleteUserLogin($user)
    {
        \DB::delete(
            "DELETE FROM users_logged_in WHERE user_id = ?",
            [$user->id]
        );
    }

    public
    function logAuthUserActivity($request)
    {
        //log the user ip address, browser, etc
        $ip = $request->ip();
        $browser = $request->header('User-Agent');
        $time = \Carbon\Carbon::now()->toDateTimeString();
        $route = $request->route()->uri();

        \DB::insert('insert into user_hits (user_id, time, url, ip_address, browser) values (?, ?, ?, ?, ?)', [\Config::get('user')->id, $time, $route, $ip, $browser]);

    }

    public
    function checkBrowserChange($request)
    {

        //$unique_id = session('unique_id');
        $unique_id = $this->myJwt->getUniqueId();

        $ip = $request->ip();
        $browser = $request->header('User-Agent');


        if ($this->user->role->relogin_on_ip_address_change == 1)
        {
            $user_logged_in = \DB::select("SELECT user_id, ip_address FROM users_logged_in WHERE ip_address = ? AND http_user_agent = ? AND user_id = ? AND unique_id =?", [$ip, $browser, $this->user->id, $unique_id]);
        } else
        {
            $user_logged_in = \DB::select("SELECT user_id, ip_address FROM users_logged_in WHERE http_user_agent = ? AND user_id = ? AND unique_id =?", [$browser, $this->user->id, $unique_id]);
        }


        if (sizeof($user_logged_in) == 1)
        {
            //
            if ($user_logged_in[0]->ip_address != $ip)
            {
                \DB::update("UPDATE users_logged_in SET ip_address = ? WHERE user_id = ?", [$ip, $this->user->id]);
            }

            return true;

        } else
        {
            //kill the login....
            Session::flush();

            return false;
        }

    }


}