<?php namespace App\Models;

use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public function truncateString($column)
    {
        $max_length =  DB::connection()->getDoctrineColumn($this->getTable(), $column)->getLength();
        $this->$column  = substr ( $this->$column , 0 ,$max_length );
        return $this->$column;

    }
//    public static function create(array $attributes = [])
//    {
//        $model = static::query()->create($attributes);
//        return $model;
//
//        try{
//            Parent::create($attributes);
//        }
//        catch(Exception $e)
//        {
//            dd($e->getMessage());
//        }
//    }
//    public static function getSelectValues($value_column, $name_column)
//    {
//        $instance = new static;
//    }
//    public static function getTreeSelectValues($value_column, $name_column)
//    {
//        $instance = new static;
//    }

    public static function getEnumValues($name){
        $instance = new static; // create an instance of the model to be able to get the table name
        $type = DB::select( DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$name.'"') )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach(explode(',', $matches[1]) as $value){
            $v = trim( $value, "'" );
            $enum[] = ['name'=> $v, 'value'=>$v];
        }
        return $enum;
    }
}