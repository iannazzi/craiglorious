<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $page = 'pages/locations/entry';

    public function returnData()
    {
        $return_data = [];
//        dd(Location::all()->toArray());
        $return_data['locations'] = Location::getSelectTree(Location::all());
//      dd($return_data);
        return $return_data;
    }
    public function search(Request $request)
    {
        $data = $request->all();
        $table_name = $data['table_name'] . '_';
        $search = $data['search_fields'];
        $name = $search[ $table_name . 'name' ];
        $id = $search[ $table_name . 'id' ];
        $parent_id = $search[ $table_name . 'parent_id' ];

        $q = Location::where('name', 'LIKE', "%{$name}%")
            ->where('id', 'LIKE', "%{$id}%");
        if ($parent_id != 'null')
        {
            $q->where('parent_id', '=', $parent_id);
        }
        $result = $q->get();
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $result,
        ], 200);

    }

    public function index()
    {
        $number_of_records_available = Location::all()->count();
        $return_data = $this->returnData();
        $return_data['page'] = 'index';
        $return_data['data'] = []; //let js handle the data through ajax
        $return_data['number_of_records_available'] = $number_of_records_available;
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);


    }

    public function show($id)
    {
        $data = Location::findOrFail($id);
        $return_data = $this->returnData();
        $return_data['page'] = 'show';
        $return_data['data'] = [$data]; //let js handle the data through ajax
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);


    }
    public function create()
    {
        $return_data = $this->returnData();
        $return_data['page'] = 'create';
        $return_data['data'] = []; //let js handle the data through ajax
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);

    }

    public function update(Request $request)
    {

        $data = $request->data[0];
        $id = $data['id'];

        $rules = array(
            'name' => 'required',
        );

        $validation = \Validator::make($data, $rules);
        if ($validation->passes())
        {
            $update = Location::firstOrNew(['id' => $id]);
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

        $data = Location::findOrFail($id);
        //$vendor->delete();
        $data['active'] = 0;
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'record deleted',
        ], 200);





    }
}
