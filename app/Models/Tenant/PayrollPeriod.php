<?php namespace App\Models\Tenant;

use App\Models\BaseModel;



class PayrollPeriod extends BaseModel {


    protected $guarded = ['id'];


    public function contents()
    {
        return $this->hasMany('App\Models\Tenant\PayrollContent');
    }

    public function total_employees(){
        //get the count of the number of employees in the contents.....

        $sql = $this->contents()->groupBy('employee_id')->count();

        return $sql;


    }
    public function total_regular_hours(){
        //get the count of the number of employees in the contents.....
        $sql = $this->contents()->sum('regular_hours');
        return $sql;
    }
    public function total_pay(){
        //get the count of the number of employees in the contents.....
        //loop through contents
        //so do i store the calculated data...  i think so...
        //the code base for calcalation can change....especially complex calcaultions....
        //what if the total calculation process changes????

        $sql = $this->contents()->sum('pre_tax_pay');
        return $sql;

    }
    public function eftps_deposit(){


    }


}