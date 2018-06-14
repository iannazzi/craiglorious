<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Account;
use App\Models\Tenant\Employee;
use App\Models\Tenant\PayrollPeriod;
use Illuminate\Http\Request;

class PayrollController extends Controller
{


    public function search(Request $request)
    {
        $data = $request->all();
        $table_name = $data['table_name'] . '_';
        $search = $data['search_fields'];


        $from = $search[ $table_name . 'start' ];
        $to = $search[ $table_name . 'end' ];
        $employee_name = $search[ $table_name . 'employee_name' ];

        $q = PayrollPeriod::where('employee_name', 'LIKE', "%{$employee_name}%");

        if ($from != '')
        {
            $from = $from . ' 00:00:00';
            $from = Carbon::createFromFormat('Y-m-d H:i:s', $from);

            if ($to != '')
            {
                $to = $to . ' 00:00:00';
                $to = Carbon::createFromFormat('Y-m-d H:i:s', $to);
                //add one day to include the end date results
                $to->addDays(1);

                $q->where('end', '>=', $from)
                    ->where('end', '<=', $to);
            } else
            {
                $q->where('end', '>=', $from);
            }

        }

        $return_data = $this->returnData();
        $payroll_periods = $q->get();
        //need to calculate total hours and pay per entry
        foreach($payroll_periods as &$record){

            $record['number_of_employees'] = $record->total_employees();
            $record['total_regular_hours'] = $record->total_regular_hours();
            $record['total_pay'] = $record->total_pay();

        }
        $return_data['records'] =  $payroll_periods;

        //dd($return_data);

        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data,
        ], 200);

    }
    public function index_data(){

    }
    public function index(Request $request)
    {
        $number_of_records_available = PayrollPeriod::all()->count();
//        $return_data['accounts'] = Account::getSelectTree(Account::all());
        $return_data = $this->returnData();
        $return_data['records'] = []; //let js handle the data through ajax
        $return_data['number_of_records_available'] = $number_of_records_available;
        if ($number_of_records_available <= $request->number_of_records)
        {
            $return_data['records'] = $this->index_data();
        }

        return response()->json([
            'success' => true,
            'message' => 'search returned',
            'data' => $return_data
        ], 200);


    }

    public function returnData()
    {
//        $return_data['types'] = Account::getAccountTypes();
//        $return_data['accounts'] = Account::all();
            $return_data = [];
        return $return_data;
    }

    public function show($id)
    {
        $data = PayrollPeriod::findOrFail($id);

        $return_data = $this->returnData();
        $return_data['records'] = [$data]; //let js handle the data through ajax
        $return_data['payroll_contents'] = $data->contents();
        $return_data['employee_select'] = Employee::employeeSelectArray();

        return response()->json([
            'success' => true,
            'message' => 'return from show',
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
    public function updateContents(Request $request){

        //pass sanitized input to payroll - model or class for creating???? model???


        $pre_tax_pay = Payroll::calculatePreTaxPay($content->hours, $content->pay_rate, 0, 0, $content->deductions);
        $medicaide = FederalPayrollTaxes::calculateEmployeeMedicaideTax($content->year, $pre_tax_pay);
        $fica = FederalPayrollTaxes::calculateEmployeeFicaTax($content->year, $pre_tax_pay);

        $fw = FederalPayrollTaxes::calculateWithholding($content->year, $pre_tax_pay, $content->single, $content->wa);
        $sw = StatePayrollTaxes::calculateWithholding($content->year, 'NY', $pre_tax_pay, $content->single, $content->wa);
        $post_tax_pay = Payroll::calculatePostTaxPay($pre_tax_pay, $medicaide, $fica, $fw, $sw);
        $paycheck_total = Payroll::calculatePaycheckTotal($post_tax_pay,0);

        $insert = [
            'payroll_period_id' => $content->payroll_period_id,
            'employee_id' => $content->employee_id,
            'regular_hours' => $content->hours,
            'pre_tax_deductions' => $content->deductions,
            'pay_rate' => $content->pay_rate,
            'single' => $content->single,
            'withholding_allowance' => $content->wa,
            'state_id' => State::getStateId('NY'),
            'medicaide_tax' => $medicaide,
            'fica_tax' => $fica,
            'federal_withholding' => $fw,
            'state_withholding' => $sw,
            'pre_tax_pay' => $pre_tax_pay,
            'post_tax_pay' => $post_tax_pay,
            'paycheck_total' => $paycheck_total
        ];


    }



    public function destroy(Request $request)
    {
        $data = $request->data;
        $id = $data['id'];

        $data = Account::findOrFail($id);
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
