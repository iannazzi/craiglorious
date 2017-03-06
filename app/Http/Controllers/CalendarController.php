<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEvents(Request $request)
    {
        echo json_encode([
           [
               'id'=>1,
               'title' => 'no one',
               'allDay' => false,
               'start' => '2017-03-05 10:00:00',
               'end' =>'2017-03-05 11:00:00',
               'url' => '',
               'className' => 'myclassone',
               'editable' => true,
               'startEditable'=> true,
               'durationEditable'=> true,
               'resourceEditable'=> true,
           ],
            [
                'id'=>2,
                'title' => 'not me',
                'allDay' => true,
                'start' => '2017-03-07 10:00:00',
                'url' => '',
                'className' => 'myclassone',
                'editable' => true,
                'startEditable'=> true,
                'durationEditable'=> true,
                'resourceEditable'=> true,
            ]
        ]);
    }


}
