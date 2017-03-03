<?php namespace App\Http\Controllers\Auth;

use  App\Models\Craiglorious\System;
use Redirect, Session, Log;
use Illuminate\Support\Facades\Auth;

class myAuth
{
    public static function navCheck(){
        if( ! self::loadSystem()) {return false;}
        if(! Auth::check())
        {
            //can't do this because of logout??
            //Auth::user()->system = $system;
            return false;
        }
        return true;
    }
    public static function myCheck($request)
    {
        if( ! self::loadSystem()) {return false;}
        if(! Auth::check())
        {
            //can't do this because of logout??
            //Auth::user()->system = $system;
            return false;
        }

        self::logAuthUserActivity($request);

        $user = Auth::user();
        //$unique_id = session('unique_id');
        $unique_id = \Cookie::get('unique_id');
        $ip = $request->ip();
        $browser = $request->header('User-Agent');
        $time =  \Carbon\Carbon::now()->toDateTimeString();
        $route = $request->route()->uri();


        if($user->role->relogin_on_ip_address_change == 1)
        {
            $user_logged_in = \DB::select("SELECT user_id, ip_address FROM users_logged_in WHERE ip_address = ? AND http_user_agent = ? AND user_id = ? AND unique_id =?",[$ip,$browser,$user->id, $unique_id]);
        }
        else
        {
            $user_logged_in = \DB::select("SELECT user_id, ip_address FROM users_logged_in WHERE http_user_agent = ? AND user_id = ? AND unique_id =?",[$browser,$user->id, $unique_id]);
        }


        if( sizeof($user_logged_in) == 1)
        {
            //
            if($user_logged_in[0]->ip_address != $ip)
            {
                \DB::update("UPDATE users_logged_in SET ip_address = ? WHERE user_id = ?",[$ip,$user->id]);
            }
            return true;

        }
        else
        {
            Session::flush();
            return false;
        }

    }
    public static function loadSystem()
    {
        $system_id = session('system');
        $system = System::find($system_id);
        if ( ! $system)
        {
            Log::error('no system');
            Session::flush();

            return false;
        }
        if ( !  $system->createTenantConnection())
        {
            //an issue occured conneting....
            Log::error('myAuth.php: failed to connect to system database');
            Session::flush();

            return false;
        }
        return true;

    }
    public static function logAuthUserActivity($request){
        //log the user ip address, browser, etc
        $user = Auth::user();
        $ip = $request->ip();
        $browser = $request->header('User-Agent');
        $time =  \Carbon\Carbon::now()->toDateTimeString();
        $route = $request->route()->uri();

        \DB::insert('insert into user_hits (user_id, time, url, ip_address, browser) values (?, ?, ?, ?, ?)', [$user->id, $time, $route, $ip, $browser]);

    }
    public static function logoutUser($id){
        \DB::delete(
            "DELETE FROM users_logged_in WHERE user_id = ?",
            [$id]
        );
    }

}