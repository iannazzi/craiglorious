<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class Payment extends BaseModel {


    protected $guarded = ['id'];

    function getBills(){
        //a payment can have many bills.....
        $query = \DB::table('bill_payment');
        $query->where('payment_id', '=', $this->id);
        $results = $query->get();
        return $results;
    }

}