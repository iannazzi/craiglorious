<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;

class State extends BaseCraigloriousModel {


	protected $fillable = [
		'default_state_tax',
		'name',
		'short_name'
	    ];

	public static function stateSelectArray(){
        $states = State::all();
        $rtn = [];
        foreach($states as $state){
            $rtn[]= array('name' => $state->name, 'value' => $state->id);
        }
        return $rtn;
    }

}