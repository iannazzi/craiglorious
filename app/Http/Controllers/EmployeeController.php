<?php

namespace App\Http\Controllers;
use App\Models\Craiglorious\State;
use Illuminate\Http\Request;
Use App\Models\Tenant\User;
use App\Http\Requests;
use App\Models\Tenant\Employee;
use DB ;

class EmployeeController extends Controller
{

    public function search(Request $request)
    {
        $data = $request->all();
        $table_name = $data['table_name'] . '_';
        $search = $data['search_fields'];
        $first_name = $search[ $table_name . 'first_name' ];
        $last_name = $search[ $table_name . 'last_name' ];
        $full_name = $first_name . ' ' . $last_name;

        //$parent_id = $search[ $table_name . 'parent_id' ];
        $comments = $search[ $table_name . 'comments' ];
        $active =  $search[ $table_name . 'active' ];



    $q4 = Employee::where('comments', 'LIKE',  '%' . $comments. '%')
                    ->where('first_name', 'LIKE', '%' . $first_name. '%')
                    ->where('last_name', 'LIKE', '%' . $last_name. '%');

        $q3 = DB::table('employees')
            ->select(DB::raw("CONCAT(first_name,' ',last_name) as full_name, comments, active, id"))
            ->where(DB::raw("CONCAT(first_name,' ',last_name)"), 'LIKE', '%'.$full_name.'%')
            ->where('comments', 'LIKE',  '%'.$comments .'%');


        if ($active != 'null')
        {
            $q3->where('active', $active);
            $q4->where('active', $active);
        }

        $return_data['records'] = $q4->get();
        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data,
        ], 200);

    }
    public function index()
    {


        $number_of_records_available = Employee::all()->count();
        if ($number_of_records_available < 100)
        {
        } else
        {
            $data = [];
        }
        $return_data = $this->commonReturnData();
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

    public function commonReturnData()
    {
        $return_data['states'] = State::stateSelectArray();
        $return_data['users'] = User::userSelectArray();
        return $return_data;
    }

    public function show($id)
    {
        $q = Employee::findOrFail($id);
        $return_data = $this->commonReturnData();
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
        $return_data = $this->commonReturnData();
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
            'ss' => 'unique:employees,ss,' . $id,
        );

        $validation = \Validator::make($data, $rules);
        if ($validation->passes())
        {
            $update = Employee::firstOrNew(['id' => $id]);
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

        $q = Employee::findOrFail($id);
        //$vendor->delete();
        $q['active'] = 0;
        $q->save();


        return response()->json([
            'success' => true,
            'message' => 'record deleted',
        ], 200);


    }
}
