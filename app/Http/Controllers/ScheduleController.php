<?php

namespace App\Http\Controllers;

use App\Models\Tenant\CalendarEntry;
use App\Models\Tenant\Employee;
use Illuminate\Http\Request;

use App\Http\Requests;

//use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function returnData()
    {
        $return_data = [];

        return $return_data;
    }

    public function index(Request $request)
    {
        $entries = CalendarEntry::where('class_name', 'scheduled_shift')->get();
        $number_of_records_available = $entries->count();
        $return_data = $this->returnData();
        $return_data['records'] = []; //let js handle the data through ajax
        $return_data['number_of_records_available'] = $number_of_records_available;
        if ($number_of_records_available <= $request->number_of_records)
        {
            $return_data['records'] = $entries;
        }

        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);


    }

    public function search(Request $request)
    {
        $data = $request->all();
        $table_name = $data['table_name'] . '_';
        $search = $data['search_fields'];
        $title = $search['title'];
        $id = $search['id'];

        //start date
        //end date


//        $start = $search[ $table_name . 'start' ];
//        $end = $search[ $table_name . 'end' ];
//        $allDay = $search[ $table_name . 'all_day' ];


        $data = CalendarEntry::where('title', 'LIKE', "%{$title}%")
            ->where('id', 'LIKE', "%{$id}%");

        $result = $data->get();


        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $result
        ], 200);


    }

    public function show($id)
    {
        $data = Printer::findOrFail($id);
        $return_data = $this->returnData();
        $return_data['page'] = 'show';
        $return_data['records'] = [$data]; //let js handle the data through ajax
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);


    }

    public function update(Request $request)
    {
        //just call the calendar to update
        $cc = new CalendarController();
        return $cc->update($request);
    }

    public function destroy(Request $request)
    {
        //just call the calendar to delete
        $cc = new CalendarController();
        return $cc->destroy($request);

    }

}
