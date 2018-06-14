<?php


use App\Classes\Seeder\Demo\tables\PayrollContentsTableSeeder;
use App\Models\Tenant\PayrollPeriod;
use Tests\TestCase;
use App\Classes\Accounting\Payroll\StatePayrollTaxes;
use App\Classes\Accounting\Payroll\FederalPayrollTaxes;
use App\Classes\Accounting\Payroll\Payroll;


class PayrollCalculationTest extends TestCase
{


    //data for testing --- i think we always want to seed the demo and test with it.... makes sense....

    //data populating options..... faker, manual seeder, csv, pulling in from pos database.... hmmmmmmm

    //test the individual calculations.....

    //test the database.....demo seeded

    //create a fake payroll periods.....

    /** @test */
    function state_withholding()
    {

        $sw = StatePayrollTaxes::calculateWithholding('2017', 'NY', 131.25, true, 1);
        $this->assertEquals($sw, 0);

        $pay = 345;
        $wa = 323.1;
        $pay_subject_to_withholding = $pay - $wa;
        $expected = ($pay_subject_to_withholding - 0) * 0.04 + 0;
        $sw = StatePayrollTaxes::calculateWithholding('2017', 'NY', $pay, true, 1);
        $this->assertEquals($sw, $expected);

        $pay = 587.4;
        $married = false;
        $withholding_allowance = 1;
        $wa = StatePayrollTaxes::getWithholdingAllowance($married, $withholding_allowance);
        $pay_subject_to_withholding = $pay - $wa;
        $expected = ($pay_subject_to_withholding - 0) * 0.04 + 0;
        $sw = StatePayrollTaxes::calculateWithholding('2017', 'NY', $pay, $married, $withholding_allowance);
        $this->assertEquals($sw, $expected);

        $pay = 587.4;
        $married = false;
        $withholding_allowance = 1;
        $wa = StatePayrollTaxes::getWithholdingAllowance($married, $withholding_allowance);
        $pay_subject_to_withholding = $pay - $wa;
        $expected = ($pay_subject_to_withholding - 0) * 0.04 + 0;
        $sw = StatePayrollTaxes::calculateWithholding('2017', 'NY', $pay, $married, $withholding_allowance);
        $this->assertEquals($sw, $expected);


        $pay = 587.4;
        $married = false;
        $withholding_allowance = 13;
        $expected = 'error withholding allowance is greater than nys allowance table';
        $sw = StatePayrollTaxes::calculateWithholding('2017', 'NY', $pay, $married, $withholding_allowance);
        $this->assertEquals($sw, $expected);


        //didn't actually calculate this .....
        $pay = 80000.4;
        $married = false;
        $withholding_allowance = 1;
        $expected = 22899.712;
        $sw = StatePayrollTaxes::calculateWithholding('2017', 'NY', $pay, $married, $withholding_allowance);
        $this->assertEquals($sw, $expected);


    }

    /** @test */
    function federal_withholding()
    {

        $fw = FederalPayrollTaxes::calculateWithholding('2017', 131.25, true, 1);
        $this->assertEquals($fw, 0);

    }

    /** @test */
    function medicaide()
    {
        $year = '2018';
        $pay = 300;
        $medicaide = FederalPayrollTaxes::calculateEmployeeMedicaideTax($year, $pay);
        $expected = $pay * .0145;
        $this->assertEquals($medicaide, $expected);

    }

    /** @test */
    function FICA()
    {
        $year = '2018';
        $pay = 300;
        $fica = FederalPayrollTaxes::calculateEmployeeFicaTax($year, $pay);
        $expected = $pay * .062;
        $this->assertEquals($fica, $expected);

    }



    //now i got to test the seeder...
    /** @test */
    function create_seed()
    {
    }


    /** @test */
    function check_demo_seeded()
    {
        $system = $this->getSystem('demo');

        $payroll_period = PayrollPeriod::all()->toArray();
        $this->Count(3, $payroll_period);

    }

    /** @test */
    function get_payroll_periods(){

        //make sure I can get payroll periods

        $system = $this->getSystem('demo');
        $payroll_period = Payroll::getPayrollPeriod('2017-12-27');
        $this->assertEquals(1, $payroll_period->id);

        $payroll_period = Payroll::getPayrollPeriod('2018-01-08');
        $this->assertEquals(1, $payroll_period->id);

        $payroll_period = Payroll::getPayrollPeriod('2018-01-09');
        $this->assertEquals(2, $payroll_period->id);

        $payroll_period = Payroll::getPayrollPeriod('2018-01-23');
        $this->assertEquals(3, $payroll_period->id);

        $payroll_periods = Payroll::getPayrollPeriods('2017-12-27', '2018-02-05');
        $this->assertCount(3, $payroll_periods);

        $payroll_periods = Payroll::getPayrollPeriodsForQuarter('2018', 1);
        $this->assertCount(3, $payroll_periods);

        $payroll_periods = Payroll::getPayrollPeriodsForQuarter('2018', 2);
        $this->assertCount(0, $payroll_periods);

        $payroll_periods = Payroll::getPayrollPeriodsForQuarter('2017', 1);
        $this->assertCount(0, $payroll_periods);

        $payroll_periods = Payroll::getPayrollPeriodsForYear('2017');
        $this->assertCount(0, $payroll_periods);

        $payroll_periods = Payroll::getPayrollPeriodsForYear('2018');
        $this->assertCount(3, $payroll_periods);


    }


    /** @test */
    function create_payroll_contents()
    {
        $pay_rate = 18.5;
       $deductions = 0;
       $single = false;
       $wa = 1;


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
        $payroll_content = self::createPayrollContent($content);



        //a period
        //see the contents....
        //add in the


        //many periods


    }

    /** @test */
    function quarterly_federal_941()
    {

    }
    /** @test */
    function annual_federal_940()
    {

    }
    /** @test */
    function quarterly_state_nys45()
    {

    }
    /** @test */
    function annual_state_nys45()
    {

    }


    //api
    //view ..... payroll-periods index..... search... etc
    /** @test */
    function crud_payroll_period()
    {

    }
    /** @test */
    function crud_payroll_period_content()
    {

    }
    /** @test */
    function crud_payroll_period_contents()
    {

    }




}