<?php
namespace App\Classes\Seeder\Demo\tables;


use App\Classes\Seeder\BaseSeeder;
use App\Models\Tenant\PayrollContent;
use App\Models\Tenant\PayrollPeriod;

use App\Models\Craiglorious\State;
use App\Classes\Accounting\Payroll\FederalPayrollTaxes;
use App\Classes\Accounting\Payroll\StatePayrollTaxes;
use App\Classes\Accounting\Payroll\Payroll;
use Carbon\Carbon;


class PayrollPeriodsTableSeeder extends BaseSeeder
{
    public static function run()
    {
        self::console('PayrollsPeriodTableSeeder');
        //start, end, emily, nancy, ruby

        $start = Carbon::createFromFormat('Y-m-d', '2017-12-26');
        $end = Carbon::createFromFormat('Y-m-d', '2018-01-08');


        self::payrollPeriodGeneric($start->toDateString(), $end->toDateString(), 22.25, 8.75, 15.25);
        self::payrollPeriodGeneric($start->addDays(14)->toDateString(), $end->addDays(14)->toDateString(), 29, 11.5, 25.5);
        self::payrollPeriodGeneric($start->addDays(14)->toDateString(), $end->addDays(14)->toDateString(), 25.75, 18.5, 38.5);







    }
    public static function payrollPeriodGeneric($start, $end, $emily, $nancy, $ruby)
    {
        $payroll_period = self::createPayrollPeriod($start, $end, 305.5, '270841730270147');
        $content = [
            'payroll_period_id' => $payroll_period->id,
            'employee_id' => 0,
            'hours' => $emily,
            'deductions' => 0,
            'pay_rate' => 18.5,
            'single' => false,
            'wa' => 1,
            'year' => '2017'
        ];
        $payroll_content = self::createPayrollContent($content);

        $content = [
            'payroll_period_id' => $payroll_period->id,
            'employee_id' => 1,
            'hours' => $nancy,
            'deductions' => 0,
            'pay_rate' => 15,
            'single' => true,
            'wa' => 1,
            'year' => '2017'
        ];
        $payroll_content = self::createPayrollContent($content);

        $content = [
            'payroll_period_id' => $payroll_period->id,
            'employee_id' => 2,
            'hours' => $ruby,
            'deductions' => 0,
            'pay_rate' => 14,
            'single' => true,
            'wa' => 1,
            'year' => '2017'
        ];
        $payroll_content = self::createPayrollContent($content);

    }

    public static function createPayrollContent($content)
    {

        $content = (object) $content;
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
        return PayrollContent::create($insert);
    }
    public static function createPayrollPeriod($start, $end, $deposit, $conf){
//        $pp = new PayrollPeriod();
//        $pp->start = $start . ' 00:00:00';
//        $pp->end = $end . ' 23:59:59';
//        $pp->federal_deposit = $deposit;
//        $pp->federal_confirmation = $conf;
//        $pp->save();
//        dd($pp->toArray());


        $insert = [

                'start' => $start . ' 00:00:00',
                'end' => $end. ' 23:59:59',
                'federal_deposit' => $deposit,
                'federal_confirmation' => $conf,

        ];
        return PayrollPeriod::create($insert);
    }
}
