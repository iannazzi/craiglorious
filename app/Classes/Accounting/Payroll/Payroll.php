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
            ->where('start', '>=', $from)
            ->where('end', '<=', $to)
            ->get()->toArray();

        //or

//1 and 3        $entries = PayrollPeriod::where('start', '<=', $from)
//            ->orWhere('end', '>=', $to)
//            ->get()->toArray();

//1 and 3        $entries = PayrollPeriod::whereRaw("start <= ? OR end >= ?",
//            array($from." 00:00:00", $to." 23:59:59")
//        )->get();

    $entries = \DB::select("SELECT id FROM payroll_periods WHERE start >= ? AND end <= ?", [$from." 00:00:00", $to." 23:59:59"]);

        $entries = \DB::select("SELECT id FROM payroll_periods WHERE start <= ? AND end <= ?", [$to." 00:00:00", $to." 23:59:59"]);





//    dd($entries);
        // 2 and 3  $entries = \DB::select("SELECT id FROM payroll_periods WHERE start BETWEEN str_to_date(?,'%Y-%m-%d') AND str_to_date(?,'%Y-%m-%d')", [$from. " 00:00:00", $to." 23:59:59"]);
      // 2 and 3  $entries = \DB::select("SELECT id FROM payroll_periods WHERE start BETWEEN ? AND ?", [$from, $to]);
//        $entries =  PayrollPeriod::all();

        return $entries;
    }

    public static function getPayrollPeriod($date)
    {

        // date should be format YYYY-MM-DD

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

//        $sql = \DB::select("SELECT id FROM payroll_periods WHERE start >= ? AND end <= ?", [$year."-01-01 00:00:00", $year."-12-31 23:59:59"]);

        $entries = \DB::select("SELECT id FROM payroll_periods WHERE end >= ? AND end <= ?",[$year."-01-01 00:00:00", $year."-12-31 23:59:59"]);
        return $entries;


    }
    public static function getPayrollPeriodsForQuarter($year, $quarter_number){

        $date_range = self::getQuarterDateRange($year, $quarter_number);

        //  the end date must be greater than or equal to  than  1-1-2018 quarter-start
        // and the end date must be less than or equal to 3-31-2018

        $entries = \DB::select("SELECT id FROM payroll_periods WHERE end >= ? AND end <= ?", [$date_range['start']." 00:00:00", $date_range['end']." 23:59:59"]);
        return $entries;

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
        //did I even code this?

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