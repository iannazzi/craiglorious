<?php namespace App\Models;


class BaseTenantModel extends BaseModel {

//    protected $connection = 'bunk';
//
//    public function __construct(System $system)
//    {
//        $this->connection = $system->dbc();
//        parent::__construct();
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