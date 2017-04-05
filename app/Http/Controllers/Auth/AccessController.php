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
        //at this point, we made it through middle ware so we are all set.....

        return response()->json([
            'success' => true,
        ], 200);

    }


}
