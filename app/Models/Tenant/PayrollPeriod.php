<?php namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Models\Craiglorious\FederalPayrollTax;
use App\Models\Craiglorious\StatePayrollTax;



class PayrollPeriod extends BaseModel {


    protected $guarded = ['id'];


    public function contents()
    {
        return $this->hasMany('App\Models\Tenant\PayrollContent');
    }



}