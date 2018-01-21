<?php

namespace App\Http\Controllers;
use App\Models\Craiglorious\State;
use App\Models\Tenant\Customer;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB ;

class CustomerController extends Controller
{

    public function search(Request $request)
    {
        $data = $request->all();
        $table_name = $data['table_name'] . '_';
        $search = $data['search_fields'];
        $first_name = $search[ $table_name . 'first_name' ];
        $last_name = $search[ $table_name . 'last_name' ];
        $comments = $search[ $table_name . 'comments' ];
        $active =  $search[ $table_name . 'active' ];
        $phone =  $search[ $table_name . 'phone' ];
        $email =  $search[ $table_name . 'email' ];




        $q = Customer::where('comments', 'LIKE',  '%' . $comments. '%')
                    ->where('first_name', 'LIKE', '%' . $first_name. '%')
                    ->where('last_name', 'LIKE', '%' . $last_name. '%')
                    ->where('phone', 'LIKE', '%' . $phone. '%')
                    ->where('email', 'LIKE', '%' . $email. '%');



        if ($active != 'null')
        {
            $q->where('active', $active);
        }

        $return_data['records'] = $q->get();
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data,
        ], 200);

    }
    public function index()
    {


        $number_of_records_available = Customer::all()->count();
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
        $q = Customer::findOrFail($id);
        $return_data['page'] = 'show';
        $return_data['records'] = [$q];
        $return_data['states'] = State::stateSelectArray();
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);


    }

    public function create()
    {
        $return_data['page'] = 'create';
        $return_data['states'] = State::stateSelectArray();
        $return_data['records'] = []; //let js handle the data through ajax
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);


    }

    public function store(Request $request)
    {
        dd('handled by update');

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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email',
        );

        $validation = \Validator::make($data, $rules);
        if ($validation->passes())
        {
            $update = Customer::firstOrNew(['id' => $id]);
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
        return response()->json([
            'success' => false,
            'message' => json_decode($errors)
        ], 422);



    }

    public function destroy(Request $request)
    {
        $data = $request->data;
        $id = $data['id'];

        $vendor = Customer::findOrFail($id);
        $vendor['active'] = 0;
        $vendor->save();


        return response()->json([
            'success' => true,
            'message' => 'record deleted',
        ], 200);


    }
}
