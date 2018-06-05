<?php namespace App\Classes\Accounting\Payroll;

use App\Models\Tenant\PayrollPeriod;
use App\Models\Tenant\PayrollContent;


class Payroll
{
    //payroll_period has the date range
    //payroll has the employee information
    //should payroll also have a date range? prob no...

    //questions
    //calculate payroll for a given period ($start -> $end)
    //calculate payroll for a quarter same as above
    //select a payroll period .... it will have an id... nice...
    //calculate how much one employee made during a date range
        //get the payroll periods
        //get the contents for just the one employee
        //should now be able to calculate


    public function __construct()
    {

    }
    public static function getPayrollPeriods($from, $to){
        $entries = \DB::table('payroll_periods')
            ->where('end', '>=', $from)
            ->where('end', '<=', $to)
            ->get()->toArray();

        //or
        $entries = PayrollPeriod::where('end', '>=', $from)
            ->where('end', '<=', $to)
            ->get()->toArray();

        return $entries;
    }
    public static function getPayrollPeriod($date){

//        $entry = PayrollPeriod::where('start', '>=', $date)
//            ->where('end', '<=', $date)
//            ->firstOrFail()->toArray();
//        dd($entry);

//        $payroll_period = PayrollPeriod::whereRaw("start <= ? AND end >= ?",
//            array($date." 00:00:00", $date." 23:59:59")
//        )->get();
//        dd($payroll_period);

        $payroll_period = PayrollPeriod::whereRaw("start >= ? AND end <= ?",
            array($date." 00:00:00", $date." 23:59:59")
        )->get();
        dd('buggg');



        //$payroll_period = PayrollPeriod::whereBetween('start', [$from, $to])->get();

        //dd(\DB::getQueryLog());


dd(PayrollPeriod::all()->toArray());



        return $payroll_period;
    }
    public static function getEmployees( $from, $to){
        $entries = PayrollPeriod::select('employee_id')->where('payroll_id')
            ->distinct()
            ->where('end', '<=', $to)
            ->where('class_name', 'scheduled_shift')
            ->get()->toArray();

        //joining.....



        return $entries;
    }
    public static function calculatePay($hours, $rate, $ot_hours, $ot_rate, $pre_tax_deduction){
        return ($hours*$rate) + ($ot_hours*$ot_rate) - $pre_tax_deduction;
    }
}