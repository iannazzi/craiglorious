<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{


    public function search(Request $request)
    {
        $data = $request->all();
        $table_name = $data['table_name'] . '_';
        $search = $data['search_fields'];
        $coa = $search[ $table_name . 'coa_number' ];
        $name = $search[ $table_name . 'name' ];
        $type = $search[ $table_name . 'type' ];
        //$parent_id = $search[ $table_name . 'parent_id' ];
        $comments = $search[ $table_name . 'comments' ];
        $active = $search[ $table_name . 'active' ];

        $q = Account::where('coa_number', 'LIKE', "%{$coa}%")
            ->where('name', 'LIKE', "%{$name}%");
        if ($type != 'null')
        {
            $q->where('type', '=', $type);
        }
//        if ($parent_id != 'null')
//        {
//            $q->where('parent_id', '=', $parent_id);
//        }
        $q->where('comments', 'LIKE', "%{$comments}%");
        if ($active != 'null')
        {
            $q->where('active', '=', $active);
        }

        $return_data['records'] = $q->get();

        //dd($return_data);

        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data,
        ], 200);

    }

    public function index(Request $request)
    {
        $number_of_records_available = Account::all()->count();
        $return_data['accounts'] = Account::getSelectTree(Account::all());
        $return_data['types'] = Account::getAccountTypes();

        $return_data['page'] = 'index';
        $return_data['records'] = []; //let js handle the data through ajax
        $return_data['number_of_records_available'] = $number_of_records_available;
        if ($number_of_records_available <= $request->number_of_records)
        {
            $return_data['records'] = Account::all(); //let js handle the data through ajax
        }

        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);


    }

    public function returnData()
    {
        $return_data['types'] = Account::getAccountTypes();
        $return_data['accounts'] = Account::all();

        return $return_data;
    }

    public function show($id)
    {
        $data = Account::findOrFail($id);
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
        //send back data needed to create
        $return_data = $this->returnData();

        $return_data['select_data_needed'] = [];

        $return_data['records'] = [];

        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);
    }

    public function update(Request $request)
    {

        $data = $request->data[0];
//        dd($data);
        $id = $data['id'];


        $rules = array(
            'name' => 'required',
            'type' => 'required',
            'coa_number' => 'required'
        );

        $validation = \Validator::make($data, $rules);
        if ($validation->passes())
        {
            $update = Account::firstOrNew(['id' => $id]);
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

        $data = Account::findOrFail($id);
        //$vendor->delete();
        if ($data->required)
        {
            return response()->json([
                'success' => false,
                'message' => 'This is a required account',
            ], 403);
        } else
        {


            $data['active'] = 0;
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'record deleted',
            ], 200);
        }


    }
}
