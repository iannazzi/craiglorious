<?php
namespace App\Http\Controllers;

use App\Models\Tenant\CalendarEntry;
use Illuminate\Http\Request;
use Auth, View;


class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $user = \Auth::user();

        $return = [
            'views'=> $user->views(),
        ];
        return $return;
        //return View::make('dashboard/vue');
        //return View::make('pages/dashboard',['server_data' => json_encode($return)]);


    }
    public function pageData(Request $request){
        //this should give me a bunch of stuff needed for all pages to speed up loading.....?
        $dashboard_page_data = [
            'calendar'=> [
                'event_types' => CalendarEntry::getEventTypes(),
            ]
        ];
        return  [
            'page_data' => $dashboard_page_data,
        ];
    }


}