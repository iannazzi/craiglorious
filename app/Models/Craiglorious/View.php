<?php namespace App\Models\Craiglorious;

use App\Models\BaseCraigloriousModel;

class View extends BaseCraigloriousModel
{

    protected $guarded = [
        'id'
    ];
    protected $casts = [
        'place' => 'json'
    ];



//      looks like a dead function if you come acrosss it maybe get rid of it....

//    public function isRole()
//    {
//        if (strtolower($this->name) == 'role')
//        {
//            return true;
//        }
//
//        return false;
//    }


}