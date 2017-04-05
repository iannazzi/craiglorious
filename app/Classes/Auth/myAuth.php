<?php namespace App\Classes\Auth;

use App\Classes\Auth\myJwt;
use  App\Models\Craiglorious\System;
use App\Models\Tenant\User;
use Illuminate\Http\Request;
use  Redirect, Session, Log, DB;
use Illuminate\Support\Facades\Auth;
use \Hash;




class myAuth
{
    protected $myJwt;
    public $user;
    function __construct()
    {
        $this->myJwt = new myJwt();
    }

    public function checkLoginReturnToken(Request $request){

        $username = $request->username;
        $password = $request->password;
        $company = $request->company;

        $system = System::where('company', $company)->first();
        if(!$system)
        {
            return response()->json(['error' => 'could not validate system'], 401);
        }
        $system->createTenantConnection();
        \Config::set('tenant_system', $system);

        $user = User::where('username', $username)
            ->first();
        if( ! $user){
            return response()->json(['error' => 'could not validate user'], 401);
        }


        if (Hash::check($password, $user->password)) {
            \Config::set('user', $user);
            $this->user = $user;
            //this user is logged in...

            //$this->deleteUserLogin($user);
            //$this->addUserLogin($request);

            $token = $this->myJwt->createFirebaseToken($user, $company);
            return response()->json(compact('user','token'));

        }
        return response()->json(['error' => 'could not validate user'], 401);


    }


    public function checkUserIsAuthenticated(Request $request){
        $authHeader = $request->headers->get('authorization');

        if ($authHeader)
        {
            $token = str_replace('Bearer ', '', $authHeader);
//            list($token) = sscanf($authHeader->toString(), 'Bearer %s');
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

                    \Config::set('user', $user);
                    $this->user = $user;







                    $this->logAuthUserActivity($request);


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



    //need to re-implement here....



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
    public  function deleteUserLogin($user){
        \DB::delete(
            "DELETE FROM users_logged_in WHERE user_id = ?",
            [$user->id]
        );
    }
    public  function addUserLogin($request){
        $user = $this->user;
        $unique_id = uniqid();
        $ip = $request->ip();
        $browser = $request->header('User-Agent');
        $time =  \Carbon\Carbon::now()->toDateTimeString();
        //log the user ip address, browser, etc
        \DB::insert('insert into users_logged_in (user_id, last_accessed, url, ip_address, http_user_agent, unique_id) values (?, ?, ?, ?, ?,?)', [$user->id, $time, 'dashboard', $ip, $browser, $unique_id]);

    }
//    public function login(Request $request){
//        // grab credentials from the request
//        // will it be username or email?
//        $username = $request->only('username');
//        $password = $request->only('password');
//        $company = $request->only('company');
//        $system = System::where('company', '=', $company['company'])->first();
//
//        if(!$system)
//        {
//            return response()->json(['error' => 'invalid_credentials'], 401);
//        }
//
//        $system->createTenantConnection();
//
//
//        $user = User::where('username', $username)
//            ->where('password', bcrypt('password'))
//            ->first();
//
//        dd($user);
//        if( ! $user){
//            return response()->json(['error' => 'invalid_credentials'], 401);
//        }
//
//
//        $customClaims = ['company' => $company['company'], 'system' => $system->id];
//
//        try {
//            // attempt to verify the credentials and create a token for the user
//            if (! $token = JWTAuth::attempt($credentials, $customClaims)) {
//                return response()->json(['error' => 'invalid_credentials'], 401);
//            }
//        } catch (JWTException $e) {
//            // something went wrong whilst attempting to encode the token
//            return response()->json(['error' => 'could_not_create_token'], 500);
//        }
//
//
//        $user = \Auth::user()->toArray();
//        myAuth::addUserLogin($request);
//
//        return response()->json(compact('user','token'));
//    }

}