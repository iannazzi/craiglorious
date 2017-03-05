<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function search(Request $request)
    {
        $data = $request->all();
        $table_name = $data['table_name'] . '_';
        $search = $data['search_fields'];
        $name = $search[ $table_name . 'name' ];
        $id = $search[ $table_name . 'id' ];

        $q = Role::where('name', 'LIKE', "%{$name}%")
            ->where('id', 'LIKE', "%{$id}%");

        $result = $q->get();
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $result,
        ], 200);

    }

    public function index(Request $request)
    {
        //return response($request->user());
        $number_of_records_available = Role::all()->count();
        $return_data['roles'] = [];//getRoleChildrenIds()
        $return_data['page'] = 'index';
        $return_data['data'] = []; //let js handle the data through ajax
        $return_data['number_of_records_available'] = $number_of_records_available;

        return response()->json([
            'success' => true,
            'message' => 'index returned',
            'data' => $return_data,
        ], 200);



    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        $return_data['page'] = 'show';
        $return_data['data'] = [$role]; //let js handle the data through ajax
        $return_data['view'] = $role->systemViews();
        return \View::make('pages/roles/roles', ['json' => json_encode($return_data)]);

    }
    public function views()
    {

        return \Auth::user()->views();

    }
    public function create()
    {
        $return_data['page'] = 'create';
        $return_data['data'] = []; //let js handle the data through ajax
        return \View::make('pages/roles/roles', ['json' => json_encode($return_data)]);

    }

    public function update(Request $request)
    {

        $data = $request->data[0];
        $id = $data['id'];

        $rules = array(
            'name' => 'required|unique:roles,name,' . $id,
        );

        $validation = \Validator::make($data, $rules);
        if ($validation->passes())
        {
            $update = Role::firstOrNew(['id' => $id]);
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


    }

    public function destroy(Request $request)
    {
        $data = $request->data;
        $id = $data['id'];
        if($id==1)
        {
            return response()->json([
                'success' => false,
                'message' => 'Can not delete the admin role',
            ], 422);
        }
        else{
            Role::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Success',
            ], 200);
        }

        //$vendor = Vendor::findOrFail($id);
        //$vendor->delete();
        //$vendor['active'] = 0;
        //$vendor->save();







    }
}
