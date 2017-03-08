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
        echo json_encode(CalendarEntry::all()->toArray());
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
        $title = $search[ $table_name . 'title' ];
        $id = $search[ $table_name . 'id' ];
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

        $data = $request->data[0];
        $id = $data['id'];

        $rules = array(
            'title' => 'required',
            'start' => 'date',
            'end' => 'date',
        );

        $validation = \Validator::make($data, $rules);
        if ($validation->passes())
        {
            $update = CalendarEntry::firstOrNew(['id' => $id]);
            //$update = Vendor::find($id);
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

        //$request->merge(json_decode($request->getContent(),true));

//        $data = $request->data;
//        $this->validate($data, [
//            'name' => 'required|unique:vendors',
//        ]);
//        $vendor = Vendor::find($id);
//        return json_encode($vendor);
        //$vendor->update($data[0]);
        //return json_encode($data[0]);


    }
    public function destroy(Request $request)
    {
        $data = $request->data;
        $id = $data['id'];

        $data = Vendor::findOrFail($id);
        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'record deleted',
        ], 200);


    }

}
