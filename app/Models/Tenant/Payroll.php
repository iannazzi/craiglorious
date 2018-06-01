<?php namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Models\Craiglorious\FederalPayrollTax;
use App\Models\Craiglorious\StatePayrollTax;



class Payroll extends BaseModel {


    protected $guarded = ['id'];

    function getBills(){
        //a payment can have many bills.....
        $query = \DB::table('bill_payment');
        $query->where('payment_id', '=', $this->id);
        $results = $query->get();
        return $results;
    }
    function totalPay(){
        return ($this->regular_hours * $this->pay_rate) + $this->calculateOvertimePay() -$this->pre_tax_deductions;
    }
    public function calculateOvertimePay(){
        return $this->overtime_hours * $this->overtime_rate * $this->pay_rate;
    }
    function year(){
        $date = DateTime::createFromFormat("Y-m-d H:i:s", $this->start);
        return $date->format("Y");
    }
    function getFederalTax(){

        $tax = FederalPayrollTax::where('year',$this->year())->firstOrFail();
        return $tax;
    }
    function medicaideRate(){
        $tax = $this->getFederalTax();
        return $tax->medicaide_rate;
    }
    function medicaideTotal(){
        return  $this->medicaideRate() * $this->totalPay();
    }
    function ficaRate(){
        $tax = $this->getFederalTax();
        return $tax->fica_rate;
    }
    function ficaTotal(){
        return $this->ficaRate() * $this->totalPay();
    }
    function federalTaxWithholdingTable(){
        $tax = $this->getFederalTax();
        return $tax->witholding;
    }
    function federalWithholding(){
        //$table = $this->federalTaxWithholdingTable();
        return getFederalTax()->WithholdingTax($this->year(), $this->totalPay(), $this->single);

    }
    function getStateTax(){

        $tax = StatePayrollTax::where('year',$this->year())->firstOrFail();
        return $tax;
    }
    function stateWithholding(){
        return getStateTax()->WithholdingTax($this->year(), $this->totalPay(), $this->single);

    }


}