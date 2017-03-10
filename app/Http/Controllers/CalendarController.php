<?php

namespace App\Http\Controllers;

use App\Models\Tenant\CalendarEntry;
use Illuminate\Http\Request;

use App\Http\Requests;
//use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function getEvents(Request $request)
    {
        $entries = CalendarEntry::all();
        return response()->json($entries->toArray());
//        $return_data = [];
//        foreach ($entries as $entry){
//            $tmp = [
//                'id' => $entry->id
//
//
//
//            ];
//
//
//
//            $return_data[] = $tmp;
//
//
//        }
////        $arr[$newkey] = $arr[$oldkey];
////        unset($arr[$oldkey]);


    }
    public function postEvents(Request $request){
        echo json_encode(['name'=>'got the post event ',
        'requesrt' => $request->all()]);
    }
    public function search(Request $request)
    {
        $data = $request->all();
        $table_name = $data['table_name'] . '_';
        $search = $data['search_fields'];
        $title = $search[ 'title' ];
        $id = $search['id' ];
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
//        dd($data);
//        $data = json_decode($data);
        $id = $data['id'];


        $rules = array(
            'title' => 'required',
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
