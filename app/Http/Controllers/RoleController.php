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
        $parent = $search[ $table_name . 'parent_id' ];


        $q = Role::where('name', 'LIKE', "%{$name}%")
            ->where('id', 'LIKE', "%{$id}%");
        if ($parent != 'null')
        {
            $q->where('parent_id', '=', $parent);
        }

        $return_data['records'] = $q->get();

        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data,
        ], 200);

    }

    public function index(Request $request)
    {

        $number_of_records_available = Role::all()->count();
        $return_data['records'] = []; //let js handle the data through ajax
        if($number_of_records_available<=20){
            $return_data['records'] = Role::all(); //let js handle the data through ajax
        }
        $return_data['roles'] = \Auth::user()->role->getRoleSelectTree();

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


        $return_data['records'] = [$role]; //let js handle the data through ajax
        $return_data['views'] = $role->systemViews();


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
        $return_data['records'] = [];


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

        if ($data['comments'] == null) $data['comments'] = '';
        $id = $data['id'];

        if ($id != '')
        {
            $role = Role::findOrFail($id);
            $children = $role->children()->pluck('id')->toArray();
            array_push($children, $id);
            $rules = array(
                'name' => 'required|unique:roles,name,' . $id,
                'parent_id' => 'required|not_in:' . implode(',', $children),
            );

        } else
        {
            $rules = array(
                'name' => 'required|unique:roles,name,' . $id,
                'parent_id' => 'required',
            );
        }


        $messages = [
            'parent_id.not_in' => 'The parent role can neither be the same nor a child as the current role. ',
            'parent_id.required' => 'A parent role is required'
        ];
        $validation = \Validator::make($data, $rules, $messages);
        if ($validation->passes())
        {
            $update = Role::firstOrNew(['id' => $id]);
            //$update = Vendor::find($id);
            $update->fill($data);
            if ($update->save())
            {


                if($id ==''){
                    //set rights
                    $update->createDefaultViews();

                }




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

    public function updateRights(Request $request)
    {
        $id = $request['additional_post_values']['id'];
        $data = $request->data;


//        $role = Role::find($id);
//        foreach ($role->views as $view) {
//            echo $view->pivot->access;
//        }
//
//        Role::find($id)->updateExistingPivot($data);
//
        foreach ($data as $row)
        {

            \DB::table('role_view')->
            where('role_id', $id)->
            where('view_id', $row['view_id'])->
            update(['access' => $row['access']]);
        }

        return response()->json([
            'success' => true,
            'message' => ''
        ], 200);

    }

    public function destroy(Request $request)
    {
        $data = $request->data;
        $id = $data['id'];
        if ($id == 1)
        {
            return response()->json([
                'success' => false,
                'message' => 'Can not delete the admin role',
            ], 422);
        } else
        {
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
