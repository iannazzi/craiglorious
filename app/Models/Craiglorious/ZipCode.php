<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;

class ZipCode extends BaseCraigloriousModel
{


    protected $fillable = [

    ];

    public function state()
    {
        $state =  State::where('short_name', $this->state)->first();
        if($state === null)
        {
            return new County();
        }
        return $state;
    }
    public function county()
    {
        $county = County::where('name', $this->county)->first();
        if($county === null)
        {
            return new County();
        }
        return $county;
    }
    public function taxJurisdiction()
    {
        return TaxJurisdiction::find($this->county()->tax_jurisdiction_id);
    }

}