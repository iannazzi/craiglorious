<?php
namespace App\Http\Controllers;

use App\Models\Tenant\CalendarEntry;
use Illuminate\Http\Request;
use Auth, View;


class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $user = \Config::get('user');

        $return = [
            'views'=> $user->views(),
        ];
        return $return;
        //return View::make('dashboard/vue');
        //return View::make('pages/dashboard',['server_data' => json_encode($return)]);


    }
    public function cachedPageData(Request $request){
        //this should give me a bunch of stuff needed for all pages to speed up loading.....?
        $cached_page_data = [
            'calendar'=> [
                'event_types' => CalendarEntry::getEventTypes(),
            ]
        ];
        return  [
            'cached_page_data' => $cached_page_data,
        ];
    }


}