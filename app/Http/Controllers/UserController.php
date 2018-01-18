<?php

namespace App\Http\Controllers;

use App\Classes\Auth\myAuth;
use App\Models\Tenant\Role;
use App\Models\Tenant\User;
use Illuminate\Http\Request;
use Faker\Factory;


class UserController extends Controller
{
    private $return_data;
    private $user;

    function __construct()
    {

        // with exception fot the admin,
        // the user can only see users with roles that are children to their role


    }

    public function search(Request $request)
    {

        //users can only search for users with roles below theirs
        $user = \Config::get('user');
        $role = $user->role;

        $users = $user->getOtherUsers();

        $data = $request->all();
        $table_name = $data['table_name'] . '_';
        $search = $data['search_fields'];
        $username = $search[ $table_name . 'username' ];
        $id = $search[ $table_name . 'id' ];
        $active = $search[ $table_name . 'active' ];
        $role_id = $search[ $table_name . 'role_id' ];


        $q = $users->where('username', 'LIKE', "%{$username}%")
            ->where('id', 'LIKE', "%{$id}%");
        if ($active != 'null')
        {
            $q->where('active', '=', $active);
        }
        if ($role_id != 'null')
        {
            $q->where('role_id', '=', $role_id);
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
        $user =  \Config::get('user');

        //dd($this->return_data['roles']);
        $number_of_records_available = User::all()->count();

        $return_data =  $user;
        $return_data['roles'] = $user->role->getRoleSelectTree();

        $return_data['page'] = 'index';
        $return_data['records'] = []; //let js handle the data through ajax
        $return_data['number_of_records_available'] = $number_of_records_available;
        if($number_of_records_available<=$request->number_of_records){
            $return_data['records'] = User::all(); //let js handle the data through ajax
        }
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data,
        ], 200);

        //
    }

    public function show($id)
    {

        $user =  \Config::get('user');
        $return_data['roles'] = $user->role->getRoleSelectTree();
        $user = User::findOrFail($id);
        if ($user->isAdmin())
        {
            if ( \Config::get('user')->isAdmin())
            {
                //good to continue
            } else
            {
                //bad bad bad... non admin cannot edit admins.
            }
        }


        $return_data['page'] = 'show';
        $return_data['records'] = [$user]; //let js handle the data through ajax

        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data,
        ], 200);




    }

    public function getPreferences()
    {
        $return_data['page'] = 'edit';
        $passcode = unique_random('users', 'passcode', 5, 'number');
        $password = createPassword();

        $user =  \Config::get('user');
        $return_data = $user;
        $return_data['pass'] = $password;
        $return_data['code'] = $passcode;

        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $return_data
        ], 200);

    }

    public function postPreferences(Request $request)
    {
        $user = \Config::get('user');
        $id = $user->id;
        $data = $request->all();



        if(isset($data['password'])){
            $rules['password'] = $this->passwordRules();
        }
        else if (isset($data['passcode'])){
            $rules['passcode'] = $this->passcodeRules($id);
        }
        $validation = \Validator::make($data, $rules);
        if ($validation->passes())
        {

            $user = User::find($id);
            if(isset($data['password'])){
                $user->password = bcrypt($data['password']);
            }
            elseif (isset($data['passcode'])){
                $user->passcode = $data['passcode'];
            }
            if ($user->save())
            {
                //kill the user login why?
//                myAuth::logoutUser($id);
                return response()->json([
                    'success' => true,
                    'message' => 'record updated',
                    'id' => $user['id']
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
    public function passwordRules(){
        return ['required',
            'min:8',
            'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d])(?=.*['.passwordSymbols().']).*$/',
            'confirmed'];
    }
    public function passcodeRules($id){
//        return ['minlength:5',
//                'maxlength:10',
//        ];
        return [
            'digits_between:5,10',
            'numeric',
            'unique:users,passcode,' . $id,
            'confirmed'];
    }
    public function create()
    {
        $passcode = unique_random('users', 'passcode', 5, 'number');
        $password = createPassword();

        $user =\Config::get('user');
        $role = $user->role;
        $return_data['roles'] = $role->getRoleSelectTree();
        $return_data['page'] = 'create';
        $return_data['password_suggestions'] = [
            [
                'password' => $password,
                'password_confirmation' => $password,
                'passcode' => $passcode,
                'passcode_confirmation' => $passcode
            ]
        ]; //let js handle the data through ajax
        return response()->json([
            'success' => true,
            'message' => 'record updated',
            'id' => $return_data
        ], 200);
        //return \View::make('pages/users/users', ['json' => json_encode($return_data)]);

    }

    public function update(Request $request)
    {

        //now I have to scrub the data...
//        $data = json_decode($request->data,true);

        $data = $request->data[0];
        $id = $data['id'];
        $rules = array(
            'role_id' => 'required|not_in:null',
            'username' => 'required|max:40|min:6|unique:users,username,' . $id,
        );
        if ($id == "")
        {
            $rules['password'] = $this->passwordRules();
//            $rules['passcode'] = 'min:5|numeric|confirmed|unique:users,passcode,' . $id;
            $rules['passcode'] = $this->passcodeRules($id);
        } else
        {
            //dd($data);
            //do not store the password sent in
            unset ($data['password']);
        }

        $validation = \Validator::make($data, $rules);
        if ($validation->passes())
        {
            if ($id == "") $data['password'] = bcrypt($data['password']);
            $update = User::firstOrNew(['id' => $id]);
            //$update = Vendor::find($id);
            $update->fill($data);
            if ($update->save())
            {
                //kill the user login
                $myAuth = new myAuth();
                $myAuth->deleteUserLogin($update);


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
        if ($id == 1)
        {
            return response()->json([
                'success' => false,
                'message' => 'Can not delete Admin',
            ], 422);
        } else
        {
            $record = User::findOrFail($id);
            //$record->delete();
            $record['active'] = 0;
            $record->save();

            return response()->json([
                'success' => true,
                'message' => 'Success',
            ], 200);
        }

    }
}
