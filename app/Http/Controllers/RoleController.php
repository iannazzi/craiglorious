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

        $return_data = $q->get();
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data,
        ], 200);

    }

    public function index(Request $request)
    {
        //return response($request->user());
        $number_of_records_available = Role::all()->count();
        $return_data['roles'] = \Auth::user()->role->getRoleSelectTree();
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


        $return_data['role'] = [$role]; //let js handle the data through ajax
        $return_data['views'] = \Auth::user()->role->systemViews();


        //the selectable roles can only be parents or siblings...
        //admin can have no parent
        //owner (2) can only be a child of admin
        //sales manager can be a child of admin or owner or accountant..
        // basically anything but children or grand children...

        $return_data['roles'] = $role->getSelectableParents();

        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data,
        ], 200);

    }
    public function views()
    {

        return \Auth::user()->views();

    }
    public function create()
    {
        $user = \Auth::user();
        $return_data['role'] = [];



        $return_data['roles'] = $user->role->getRoleSelectTree();
        $return_data['views'] = $user->role->systemViews();

        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $return_data,
        ], 200);

    }

    public function update(Request $request)
    {

        //parent id cannot be any of its children
        //parent id cannot be itself


        $data = $request->data[0];

        $id = $data['id'];

        if($id != '')
        {
            $role = Role::findOrFail($id);
            $children = $role->children()->pluck('id')->toArray();
            array_push($children, $id);
            $rules = array(
                'name' => 'required|unique:roles,name,' . $id,
                'parent_id' => 'required|not_in:' .implode(',',$children),
            );

        }
        else{
            $rules = array(
                'name' => 'required|unique:roles,name,' . $id,
                'parent_id' => 'required',
            );
        }


        $messages = [
            'parent_id.not_in' => 'The parent role can neither be the same nor a child as the current role. ',
        ];
        $validation = \Validator::make($data, $rules,$messages);
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
            $role = Role::findOrFail($id);
            $role['active'] = 0;
            $role->save();
//            Role::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Success',
            ], 200);
        }









    }
}
