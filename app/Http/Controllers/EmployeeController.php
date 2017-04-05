<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Vendor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{


    public function index()
    {


        $number_of_records_available = Vendor::all()->count();
        if ($number_of_records_available < 100)
        {
            //$data = Vendor::all();
        } else
        {
            $data = [];
        }
        $return_data['page'] = 'index';
        $return_data['records'] = []; //let js handle the data through ajax
        $return_data['number_of_records_available'] = $number_of_records_available;

        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);

        //
    }

    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);
        $return_data['page'] = 'show';
        $return_data['records'] = [$vendor]; //let js handle the data through ajax
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);


    }

    public function create()
    {
        $return_data['page'] = 'create';
        $return_data['records'] = []; //let js handle the data through ajax
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);


    }

    public function store(Request $request)
    {
        dd('store a new one....');

        //using update...

        return json_encode($request);
    }

    public function update(Request $request)
    {

        //now I have to scrub the data...
//        $data = json_decode($request->data,true);

        $data = $request->data[0];
        $id = $data['id'];

        $rules = array(
            'name' => 'required|unique:vendors,name,' . $id,
            'main_email' => 'email',
        );

        $validation = \Validator::make($data, $rules);
        if ($validation->passes())
        {
            $update = Vendor::firstOrNew(['id' => $id]);
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

        $vendor = Vendor::findOrFail($id);
        //$vendor->delete();
        $vendor['active'] = 0;
        $vendor->save();


        //Vendor::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'record deleted',
        ], 200);


    }
}
