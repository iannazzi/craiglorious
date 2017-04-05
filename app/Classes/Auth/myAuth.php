<?php namespace App\Classes\Auth;

use App\Classes\Auth\myJwt;
use  App\Models\Craiglorious\System;
use App\Models\Tenant\User;
use Illuminate\Http\Request;
use  Redirect, Session, Log, DB;
use Illuminate\Support\Facades\Auth;




class myAuth
{
    protected $myJwt;
    public $user;
    function __construct()
    {
        $this->myJwt = new myJwt();
    }

//auth verification
    public function checkUserIsAuthenticated(Request $request){

        dd($request);
        //a token has been sent for user validation....
        $myAuth = new myAuth();
        $myJwt = new myJwt();


        $authHeader = $request->headers->get('authorization');
        dd($authHeader);

        if ($authHeader)
        {

            $token = str_replace('Bearer ', '', $authHeader);
            if ($token)
            {
                if($token_data = $this->myJwt->validateFirebaseToken($token)){

                    $company = $token_data->data->company;

                    $system = System::where('company', $company)->first();
                    if(!$system)
                    {
                        return response()->json(['error' => 'could not validate system'], 401);
                    }
                    $system->createTenantConnection();
                    \Config::set('tenant_system', $system);

                    $id = $token_data->data->user_id;

                    $user = User::where('id', $id)
                        ->first();

                    if( ! $user){
                        return response()->json(['error' => 'could not validate user'], 401);
                    }


                    // has the user logged on from a different browser?

                    \Config::set('user', $user);
                    $this->user = $user;




                    return true;


                }
                else{
                    return response()->json(['error' => 'could not validate token'], 401);
                }

            } else
            {
                return response()->json(['error' => 'no_token'], 401);
            }
        }
        return response()->json(['error' => 'no_auth_header'], 401);



    }

    public function checkUserRouteAccess(){
        
    }
    //login set into database
    public  function addUserLoginToDb($request, $unique_id){
        $user = $this->user;
        $this->deleteUserLogin($user);
        $ip = $request->ip();
        $browser = $request->header('User-Agent');
        $time =  \Carbon\Carbon::now()->toDateTimeString();
        \DB::insert('insert into users_logged_in (user_id, last_accessed, url, ip_address, http_user_agent, unique_id) values (?, ?, ?, ?, ?,?)', [$user->id, $time, 'dashboard', $ip, $browser, $unique_id]);

    }
    public  function deleteUserLogin($user){
        \DB::delete(
            "DELETE FROM users_logged_in WHERE user_id = ?",
            [$user->id]
        );
    }

Ω    public  function logAuthUserActivity($request){
        //log the user ip address, browser, etc
        $ip = $request->ip();
        $browser = $request->header('User-Agent');
        $time =  \Carbon\Carbon::now()->toDateTimeString();
        $route = $request->route()->uri();

        \DB::insert('insert into user_hits (user_id, time, url, ip_address, browser) values (?, ?, ?, ?, ?)', [\Config::get('user')->id, $time, $route, $ip, $browser]);

    }

    public function checkBrowserChange($request){

        //$unique_id = session('unique_id');
        $unique_id = $this->myJwt->getUniqueId();

        $ip = $request->ip();
        $browser = $request->header('User-Agent');


        if($this->user->role->relogin_on_ip_address_change == 1)
        {
            $user_logged_in = \DB::select("SELECT user_id, ip_address FROM users_logged_in WHERE ip_address = ? AND http_user_agent = ? AND user_id = ? AND unique_id =?",[$ip,$browser,$this->user->id, $unique_id]);
        }
        else
        {
            $user_logged_in = \DB::select("SELECT user_id, ip_address FROM users_logged_in WHERE http_user_agent = ? AND user_id = ? AND unique_id =?",[$browser,$this->user->id, $unique_id]);
        }


        if( sizeof($user_logged_in) == 1)
        {
            //
            if($user_logged_in[0]->ip_address != $ip)
            {
                \DB::update("UPDATE users_logged_in SET ip_address = ? WHERE user_id = ?",[$ip,$this->user->id]);
            }
            return true;

        }
        else
        {
            //kill the login....
            Session::flush();
            return false;
        }

    }






}