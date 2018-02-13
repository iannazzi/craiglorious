<?php

namespace App\Http\Controllers;

use App\Models\Tenant\CalendarEntry;
use App\Models\Tenant\Employee;
use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function returnData()
    {
        $return_data = [];
        $return_data['employees'] = Employee::employeeSelectArray();
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
        $title = $search[$table_name .'title'];
        $comments = $search[$table_name .'comments'];
        $start = $search[ $table_name . 'start_date_start' ];
        $end = $search[ $table_name . 'start_date_end' ];
        $employee_id = $search[ $table_name . 'employee_id' ];



        $q = CalendarEntry::where('title', 'LIKE', "%{$title}%")
            ->where('comments', 'LIKE', "%{$comments}%")
            ->where('class_name', 'scheduled_shift')

        ;
        if ($employee_id != "null")
        {
            $q->where('employee_id',$employee_id);
        }
        if ($start != '')
        {
           $start = $start . ' 00:00:00';
           $from = Carbon::createFromFormat('Y-m-d H:i:s', $start);

            if ($end != ''){
                $end = $end . ' 00:00:00';
                $to = Carbon::createFromFormat('Y-m-d H:i:s', $end);
                //add one day to include the end date results
                $to->addDays(1);

                $q->where('end', '>=', $from)
                    ->where('end', '<=', $to);
            }
            else{
                $q->where('end', '>=', $from);
            }

        }

        $return_data = $this->returnData();
        $return_data['records'] = $q->get();


        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);


    }

    public function create()
    {
        //send back data needed to create
        $return_data = $this->returnData();

        $return_data['records'] = [];

        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);
    }
    public function show($id)
    {
        $data = CalendarEntry::findOrFail($id);
        $return_data = $this->returnData();
        $start = Carbon::createFromFormat('Y-m-d H:i:s', $data->start);
        $end = Carbon::createFromFormat('Y-m-d H:i:s', $data->end);
        $return_data['start_date'] = $start->toDateString();
        $return_data['start_time'] = $start->toTimeString();
        $return_data['end_date'] = $end->toDateString();
        $return_data['end_time'] = $end->toTimeString();


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
        //we need to add a few items here....


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
