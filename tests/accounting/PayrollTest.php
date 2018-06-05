<?php


use App\Models\Tenant\PayrollPeriod;
use Tests\TestCase;
use App\Models\Craiglorious\FederalPayrollTax;
use App\Models\Craiglorious\StatePayrollTax;
use App\Classes\Accounting\Payroll\Payroll;


class PayrollTest extends TestCase
{

    //create a payroll period
    /** @test */
    function check_demo_seeded()
    {
        $system = $this->getSystem('demo');
        $payroll_period = Payroll::getPayrollPeriod('2017-12-27');
//        $payroll_period = PayrollPeriod::getPayrollPeriod('2017-12-26');
        //this should be id 0;

        dd($payroll_period->contents());
        $this->assertCount(1, $payroll_period->contents());



    }
    function calculate_total_pay()
    {

    }

    //add in employees, hours, payrate, witholding



    /** @test */
    function federal_withholding()
    {


    }
    /** @test */
    function medicaide(){

    }
    /** @test */
    function FICA(){

    }

}