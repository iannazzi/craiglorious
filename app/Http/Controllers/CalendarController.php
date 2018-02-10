<?php

namespace App\Http\Controllers;

use App\Models\Tenant\CalendarEntry;
use App\Models\Tenant\Employee;
use Illuminate\Http\Request;

use App\Http\Requests;

//use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function getEvents(Request $request)
    {

        $entries = CalendarEntry::all();

        $return_data['events'] = [];
        $schedule_access = \Config::get('user')->doesUserHaveAccessToView('employees');

        $event_types = CalendarEntry::getEventTypes($schedule_access);

        $return_data['event_types'] = $event_types;
        $return_data['employees'] = Employee::employeeSelectArray();
        //does the user have access to view employees?
        $return_data['schedule_access'] = $schedule_access;
        foreach ($entries as $entry)
        {
            $tmp = [
                'id' => $entry->id,
                'employee_id'=>$entry->employee_id,
                'title' => $entry->title,
                'comments' => $entry->comments,
                'start' => $entry->start,
                'end' => $entry->end,
                'className' => $entry->class_name,
                'startEditable' => $entry->start_editable,
                'editable' => $entry->editable,
                'durationEditable' => $entry->duration_editable,
                'resourceEditable' => $entry->resource_editable,
                'allDay' => $entry->all_day,
            ];
            $return_data['events'][] = $tmp;


        }

//        return response()->json($return_data);

        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);


    }

    public function getEventTypes(){

        return response()->json( CalendarEntry::getEventTypes());
    }

    public function search(Request $request)
    {
        $data = $request->all();
        $table_name = $data['table_name'] . '_';
        $search = $data['search_fields'];
        $title = $search['title'];
        $id = $search['id'];
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

    public function update(Request $request)
    {

        //now I have to scrub the data...
//        $data = json_decode($request->data,true);

        $data = $request->data;
        $id = $data['id'];
        $end = $data['end'];
        $start = $data['start'];
        // probably want this: DateTime::createFromFormat('Y-m-d H:i:s', $myDate);
        //dd(strtotime($start) <= strtotime($end));
        $rules = array(
            'title' => 'required',
            'class_name' => 'required',
            'start' => 'required',
            'end'=>'required|after:'.$start,
        );

        $validation = \Validator::make($data, $rules);
        if ($validation->passes())
        {
            $update = CalendarEntry::firstOrNew(['id' => $id]);

            $update->fill($data);
            if ($update->save())
            {
                return response()->json([
                    'success' => true,
                    'message' => 'record updated',
                    'id' => $update['id']
                ], 200);
            }
        }
        $errors = $validation->errors();
        $errors = json_decode($errors);

        return response()->json([
            'success' => false,
            'message' => $errors
        ], 422);


    }

    public function destroy(Request $request)
    {
        $data = $request->data;
        $id = $data['id'];

        $data = CalendarEntry::findOrFail($id);
        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'record deleted',
        ], 200);


    }

}
