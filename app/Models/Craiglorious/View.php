<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;

class View extends BaseCraigloriousModel {


	protected $guarded = [
		'id'
	    ];
    protected $casts = [
        'place' => 'json'
    ];
    public function isRole()
    {
        if (strtolower($this->name)=='role'){
            return true;
        }
        return false;
    }

}