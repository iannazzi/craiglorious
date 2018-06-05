<?php namespace App\Models\Tenant;

use App\Models\BaseModel;



class PayrollPeriod extends BaseModel {


    protected $guarded = ['id'];


    public function contents()
    {
        return $this->hasMany('App\Models\Tenant\PayrollContent');
    }



}