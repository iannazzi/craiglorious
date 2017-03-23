<?php

namespace Api\Controllers;
use Dingo\Api\Facade\API, Illuminate\Support\Facades\Auth;

/**
 * @Resource('Dashboard', uri='/dashboard')
 */
class DashboardController extends BaseController
{

    public function __construct() 
    {
       // $this->middleware('jwt.auth');
    }
    public function index()
    {

        //dd('why am i at api/controllers/dashboard?');
        $user = Auth::user();
        $views = $user->getViews();
        return array('views' =>$views);

    }
    

    
}
