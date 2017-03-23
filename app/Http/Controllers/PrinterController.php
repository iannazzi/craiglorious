<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Printer;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
    private $page = 'pages/printers/printers';


    public function search(Request $request)
    {
        $data = $request->all();
        $table_name = $data['table_name'] . '_';
        $search = $data['search_fields'];
        $name = $search[ $table_name . 'name' ];
        $id = $search[ $table_name . 'id' ];
        $media = $search[ $table_name . 'media' ];
        $location_id = $search[ $table_name . 'location_id' ];

        $q = Printer::where('name', 'LIKE', "%{$name}%")
            ->where('id', 'LIKE', "%{$id}%");
        if ($media != 'null')
        {
            $q->where('media', '=', $media);
        }
        if ($location_id != 'null')
        {
            $q->where('location_id', '=', $location_id);
        }
        $result = $q->get();
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $result,
        ], 200);

    }
    public function returnData()
    {
        $return_data = [];
        $return_data['media'] = Printer::getEnumValues('media');
        return $return_data;
    }
    public function index()
    {
        $number_of_records_available = Printer::all()->count();
        $return_data = $this->returnData();
        $return_data['page'] = 'index';
        $return_data['records'] = []; //let js handle the data through ajax
        $return_data['number_of_records_available'] = $number_of_records_available;

        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
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
    public function create()
    {
        $return_data = $this->returnData();
        $return_data['page'] = 'create';
        $return_data['records'] = []; //let js handle the data through ajax
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
            'media' => 'required',
        );

        $validation = \Validator::make($data, $rules);
        if ($validation->passes())
        {
            $update = Printer::firstOrNew(['id' => $id]);
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

        $data = Printer::findOrFail($id);
        //$vendor->delete();
        $data['active'] = 0;
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'record deleted',
        ], 200);





    }
}
