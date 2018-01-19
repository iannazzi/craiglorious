<?php namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Models\BaseTenantModel;

class Location extends BaseTenantModel {


	protected $guarded = [
		'id'
	    ];
//    function static function getSelectTree($records)
//    {
//        //assumes model has id, name, and parent_id fields.
//        $records = $model->all();
//        return $this->findChildren($records, $model->id, 0);
//    }


}