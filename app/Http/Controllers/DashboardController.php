<?php
namespace App\Http\Controllers;

use App\Models\Tenant\CalendarEntry;
use Illuminate\Http\Request;
use Auth, View;


class DashboardController extends Controller
{
    public function getIndex(Request $request)
    {

        $user = \Auth::user();
        $views =
        $page_data = [
            'calendar'=> [
                'event_types' => CalendarEntry::getEventTypes(),
            ]
        ];
        $return = [
            'views'=> $user->views(),
            'page_data' => $page_data,
        ];
        //return View::make('dashboard/vue');
        return View::make('pages/dashboard',['server_data' => json_encode($return)]);


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