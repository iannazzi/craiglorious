<?php


use App\Classes\Seeder\Demo\tables\PayrollContentsTableSeeder;
use Tests\TestCase;
use App\Classes\Accounting\Payroll\StatePayrollTaxes;
use App\Classes\Accounting\Payroll\FederalPayrollTaxes;
use App\Classes\Accounting\Payroll\Payroll;




class PayrollTest extends TestCase
{
    //test the individual calculations.....

    //test the database.....demo seeded

    //create a fake payroll periods.....

    /** @test */
    function state_withholding()
    {

        $sw = StatePayrollTaxes::calculateWithholding('2017', 'NY', 131.25, true, 1);
        $this->assertEquals($sw,0);

        $pay = 345;
        $wa = 323.1;
        $pay_subject_to_withholding = $pay-$wa;
        $expected = ($pay_subject_to_withholding-0)*0.04 + 0;
        $sw = StatePayrollTaxes::calculateWithholding('2017', 'NY', $pay, true, 1);
        $this->assertEquals($sw,$expected);

        $pay = 587.4;
        $married = false;
        $withholding_allowance = 1;
        $wa = StatePayrollTaxes::getWithholdingAllowance($married, $withholding_allowance);
        $pay_subject_to_withholding = $pay-$wa;
        $expected = ($pay_subject_to_withholding-0)*0.04 + 0;
        $sw = StatePayrollTaxes::calculateWithholding('2017', 'NY', $pay, $married, $withholding_allowance);
        $this->assertEquals($sw,$expected);

        $pay = 587.4;
        $married = false;
        $withholding_allowance = 1;
        $wa = StatePayrollTaxes::getWithholdingAllowance($married, $withholding_allowance);
        $pay_subject_to_withholding = $pay-$wa;
        $expected = ($pay_subject_to_withholding-0)*0.04 + 0;
        $sw = StatePayrollTaxes::calculateWithholding('2017', 'NY', $pay, $married, $withholding_allowance);
        $this->assertEquals($sw,$expected);


        $pay = 587.4;
        $married = false;
        $withholding_allowance = 13;
        $expected = 'error withholding allowance is greater than nys allowance table';
        $sw = StatePayrollTaxes::calculateWithholding('2017', 'NY', $pay, $married, $withholding_allowance);
        $this->assertEquals($sw,$expected);


        //didn't actually calculate this .....
        $pay = 80000.4;
        $married = false;
        $withholding_allowance = 1;
        $expected =22899.712;
        $sw = StatePayrollTaxes::calculateWithholding('2017', 'NY', $pay, $married, $withholding_allowance);
        $this->assertEquals($sw,$expected);


    }
    /** @test */
    function federal_withholding(){

        $fw = FederalPayrollTaxes::calculateWithholding('2017', 131.25, true, 1);
        $this->assertEquals($fw,0);

    }
    /** @test */
    function medicaide(){
        $year = '2018';
        $pay = 300;
        $medicaide = FederalPayrollTaxes::calculateEmployeeMedicaideTax($year, $pay);
        $expected = $pay*.0145;
        $this->assertEquals($medicaide,$expected);

    }
    /** @test */
    function FICA(){
        $year = '2018';
        $pay = 300;
        $fica = FederalPayrollTaxes::calculateEmployeeFicaTax($year, $pay);
        $expected = $pay*.062;
        $this->assertEquals($fica,$expected);

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

//        PayrollContentsTableSeeder::run();

//
        //these should get the same id
        $payroll_period = Payroll::getPayrollPeriod('2017-12-27');

        $this->assertEquals(1, $payroll_period->id);

        $payroll_period = Payroll::getPayrollPeriod('2018-01-08');
        $this->assertEquals(1, $payroll_period->id);


//        $payroll_period = PayrollPeriod::getPayrollPeriod('2017-12-26');
        //this should be id 0;

//        dd($payroll_period->contents());
//        $this->assertCount(1, $payroll_period->contents());



    }
    function calculate_total_pay()
    {

    }

    //add in employees, hours, payrate, witholding



    /** @test */



}