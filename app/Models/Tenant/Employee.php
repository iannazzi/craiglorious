<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;

class Employee extends BaseTenantModel {


    protected $guarded = ['id'];
public static function removeDashes($ss){
    return str_replace('-','',$ss);
}


}