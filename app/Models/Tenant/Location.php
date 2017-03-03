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
    public static function getSelectTree($records, $parent_id = 0, $level =0)
    {
        $cat_array = array();
        for ($c = 0; $c < sizeof($records); $c ++)
        {
            if ($records[ $c ]['parent_id'] == $parent_id)
            {
                $ret_array = [];
                $ret_array['value'] = $records[ $c ]->id;
                $ret_array['name'] = $records[ $c ]->name;
                $children = self::getSelectTree($records, $records[ $c ]->id, $level + 1);
                if (sizeof($children) > 0){
                    $ret_array['children'] = $children;
                }
                $cat_array[] = $ret_array;
            }
        }
        return $cat_array;
    }

}