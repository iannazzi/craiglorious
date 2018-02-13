<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;

class Employee extends BaseTenantModel
{


    protected $guarded = ['id'];
    public function user()
    {
        $user = User::find($this->id);
        return $user;
        //return $this->belongsTo('App\Models\Tenant\User');
    }
    public static function removeDashes($ss)
    {
        return str_replace('-', '', $ss);
    }
    public static function employeeSelectArray(){
        $employees = Employee::where('active',1)->get();
        $rtn = [];
        foreach($employees as $emp){
            $rtn[]= array('name' => $emp->first_name . ' ' . $emp->last_name, 'value' => $emp->id);
        }
        return $rtn;
    }
    public static function random()
    {
        $employees = Employee::where('active',1)->get();
        $rand = rand(0,$employees->count()-1);
        return $employees[$rand];
    }
    public  function fullname(){
        return $this->first_name . ' ' . $this->last_name;
    }


}