<?php namespace  App\Models\Craiglorious;
use App\Models\BaseCraigloriousModel;


class FederalPayrollTax extends BaseCraigloriousModel {


    protected $guarded = ['id'];


    function WithholdingTax($year, $pay, $single){
        if($year == '2018'){
            if($single){


            }
        }
    }

}