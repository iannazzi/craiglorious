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
        $page_data = [
            'calendar'=> [
                'event_types' => CalendarEntry::getEventTypes(),
            ]
        ];
        $return = [
            'views'=> $user->views(),
            'page_data' => $page_data,
        ];
        return $return;
        //return View::make('dashboard/vue');
        //return View::make('pages/dashboard',['server_data' => json_encode($return)]);


    }


}