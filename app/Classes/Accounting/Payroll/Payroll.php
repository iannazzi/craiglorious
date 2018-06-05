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

    public static function getPayrollPeriods($from, $to)
    {
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

    public static function getPayrollPeriod($date)
    {
//query example
//this works
//        $payroll_period = \DB::select("SELECT id FROM payroll_periods WHERE start <= ? AND end >= ?", [$date." 00:00:00", $date." 23:59:59"]);

        //this will return an array not an object
//        dd($sql);

//this works

        $payroll_period = PayrollPeriod::where('start', '<=', $date)
            ->where('end', '>=', $date)
            ->firstOrFail();
//        dd($entry);

        //this works...
//        $payroll_period = PayrollPeriod::whereRaw("start <= ? AND end >= ?",
//            array($date." 00:00:00", $date." 23:59:59")
//        )->get();
//        dd($payroll_period->toArray());





        return $payroll_period;
    }

    public static function getPayrollPeriodsForYear($year){

        $sql = \DB::select("SELECT id FROM payroll_periods WHERE start <= ? AND end >= ?", [$year."-01-01 00:00:00", $year."-12-31 23:59:59"]);
        dd($sql);

    }
    public static function getQuarterDateRange($year, $quarter){
        // 1 2 3 or 4
        switch ($quarter) {
            case 1:
                return ['start' => $year.'-01-01 00:00:00', 'end' => $year.'-03-31 23:59:59' ];
                break;
            case 2:
                return ['start' => $year.'-04-01 00:00:00', 'end' => $year.'-06-30 23:59:59' ];
                break;
            case 3:
                return ['start' => $year.'-07-01 00:00:00', 'end' => $year.'-09-30 23:59:59' ];
                break;
            case 4:
                return ['start' => $year.'-10-01 00:00:00', 'end' => $year.'-12-31 23:59:59' ];
                break;
        }

    }


    public static function getEmployees($from, $to)
    {
        $entries = PayrollPeriod::select('employee_id')->where('payroll_id')
            ->distinct()
            ->where('end', '<=', $to)
            ->where('class_name', 'scheduled_shift')
            ->get()->toArray();

        //joining.....


        return $entries;
    }

    public static function calculatePreTaxPay($hours, $rate, $ot_hours, $ot_rate, $pre_tax_deduction)
    {
        return ($hours * $rate) + ($ot_hours * $ot_rate) - $pre_tax_deduction;
    }

    public static function calculatePostTaxPay($pre_tax_pay, $medicaide, $fica, $fw, $sw)
    {
        return $pre_tax_pay - $medicaide - $fica - $fw - $sw;
    }

    public static function calculatePaycheckTotal($post_tax_pay, $deductions)
    {
        return $post_tax_pay - $deductions;
    }

}