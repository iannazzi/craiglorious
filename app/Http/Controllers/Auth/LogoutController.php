<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth,DB;

class LogoutController extends Controller
{



    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'logout']);
    }
    public function postLogout(Request $request){
        \Auth::logout();
        return response()->json([
            'success' => true,
            'message' => 'logout',
            'data' => []
        ], 200);
    }
    public function getLogout()
    {

        //add in the browser?

        DB::delete("DELETE FROM users_logged_in WHERE user_id = ?",[Auth::user()->id]);

        \Auth::logout();
        return redirect('auth/login');
    }

}
