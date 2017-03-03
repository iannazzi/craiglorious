<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, View;


class DashboardController extends Controller
{
    public function getIndex(Request $request)
    {

        $user = \Auth::user();
        $views = $user->views();
        //return View::make('dashboard/vue');
        return View::make('pages/dashboard',['views' => json_encode($views)]);


    }
    public function getAIndex(Request $request)
    {
        return View::make('dashboard/angular',$this->binders());
    }
    public function getVIndex(Request $request)
    {
        return View::make('dashboard/vue',$this->binders());
    }

}