<?php
namespace App\Classes\Seeder\Demo\tables;


use App\Classes\Seeder\BaseSeeder;
use App\Models\Tenant\PayrollContent;
use App\Models\Tenant\PayrollPeriod;

use App\Models\Craiglorious\State;
use App\Classes\Accounting\Payroll\FederalPayrollTaxes;
use App\Classes\Accounting\Payroll\StatePayrollTaxes;
use App\Classes\Accounting\Payroll\Payroll;

class PayrollPeriodsTableSeeder extends BaseSeeder
{
    public static function run()
    {
        self::console('PayrollsPeriodTableSeeder');
        self::payrollPeriodOne();
//        self::payrollPeriodTwo();

    }

    public static function payrollPeriodOne()
    {
        $payroll_period = new PayrollPeriod();
        $insert = [

            'start' => '2017-12-26 00:00',
            'end' => '2018-01-08 23:59',
            'federal_deposit' => 305.5,
            'federal_confirmation' => '270841730270147',

        ];
        $payroll_period = PayrollPeriod::create($insert);
        //dd($payroll_period->toArray());

        $content = [
            'payroll_period_id' => $payroll_period->id,
            'employee_id' => 0,
            'hours' => 29.25,
            'deductions' => 127.5,
            'pay_rate' => 18.5,
            'single' => false,
            'wa' => 1,
            'year' => '2017'
        ];

        $payroll_content = self::createPayrollContent($content);


    }

    public static function createPayrollContent($content)
    {

        $content = (object) $content;
        $total_pay = Payroll::calculatePay($content->hours, $content->pay_rate, 0, 0, $content->deductions); //413.625
        $medicaide = FederalPayrollTaxes::calculateEmployeeMedicaideTax($content->year, $total_pay);
        $fa = FederalPayrollTaxes::calculateWithholding($content->year, $total_pay, $content->single, $content->wa);
        $fica = FederalPayrollTaxes::calculateEmployeeFicaTax($content->year, $total_pay);
        $sa = StatePayrollTaxes::calculateWithholding($content->year, 'NY', $total_pay, $content->single, $content->wa);

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
            'federal_withholding' => $fa,
            'state_withholding' => $sa

        ];
        return PayrollContent::create($insert);
    }

//    public static function payrollPeriodTwo()
//    {
//        $insert = [
//            [
//                'start' => '2018-01-09 00:00',
//                'end' => '2018-01-22 23:59',
//                'federal_deposit' => 264.22,
//                'federal_confirmation' => '270843132988096',
//            ]
//        ];
//        $payroll_period = PayrollPeriod::insert($insert);
//        $payroll_period->id;
//    }
}
