<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;


class StatePayrollTax extends BaseCraigloriousModel {


    protected $guarded = ['id'];

    function WithholdingTax($year, $pay, $single){
        if($year == '2018'){
            if($single){
                //now wht the fuck>>>>>>

            }
        }
    }

}