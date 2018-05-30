<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class Bill extends BaseModel
{

    protected $guarded = ['id'];


    function getPayments()
    {
        //a bill can have many payments....
        $query = \DB::table('bill_payment');
        $query->where('bill_id', '=', $this->id);
        $results = $query->get();
        return $results;

    }


}