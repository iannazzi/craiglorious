<?php
/**
 * Created by PhpStorm.
 * User: embrasse-moi
 * Date: 1/17/17
 * Time: 11:06 AM
 */

namespace App\Classes\Views;


use App\Classes\Library\ArrayOperator;

class ViewHelpers
{
    public static function spitCellTypes()
    {
        $types = [
            "hidden",
            "row_checkbox",
            "input",
            "checkbox",
            "select" => [
                "names" => [],
                "values" => []],
            "tree_select" => [
                "names" => [],
                "children" => []],
            "individual_select" => [
                "names" => [],
                "values" => []],
            "textContent",
            "innerHTML",
            "row_number",
            "none",
            "date",
            ["link" => [
                "id" => "id",
                "url" => "url"]],
            ["button" => [
                "id" => "id",
                "url" => "url"]]
        ];
        return self::json_to_php_import(json_encode($types));
    }

    public static function spitTableDef($model)
    {
        $cd = [];
        foreach ($model[0] as $key => $value)
        {

            $cd[] = self::tableDef($key, $value);

        }

        $td = [
            "name" => "name",
            "access" => "READ WRITE",
            "table_type" => "KEY_VALUE INDEX",
            "post_url" => "test",
            "footer" => [],
            "header" => [],
            "column_definition" => $cd
        ];

        //dd($td);
        //return self::json_to_php_import(json_encode($td));
        return json_encode($td);
        //return self::array_to_printable_importable($td, '$var = [') . '];';


    }

    public static function tableDef($key)
    {
        $td = [
            "db_field" => $key,
            //"data" => $key,
            "caption" => $key,
            'array' => false,
            'default_value' => false,
            "show_column" => true,
            "show_on_view_edit" => true,
            "th_width" => 10,
            "td_tags" => '',
            "class" => '',
            "events" => [],
            "type" => "html date input checkbox select tree_select button link",
            "search" => "LIKE ANY BETWEEN EXACT",
            "properties" => [],
            "total" => 0,
            "round" => 0,
            'word_wrap' => true
        ];
        return $td;
    }

    public static function columnDefinition($table)
    {

    }
    public static function json_to_php_import($arr)
    {
        $arr = str_replace(':', '=>', $arr);
        $arr = str_replace(',', ', ' . PHP_EOL, $arr);
        $arr = str_replace('{', '[', $arr);
        $arr = str_replace('}', ']', $arr);
        $arr = str_replace('\\', '', $arr);

        return $arr;
    }

    public static function array_to_printable_importable($array, $str = '')
    {


        foreach ($array as $key => &$value)
        {
            if (is_array($value))
            {
                $str .= '"' . $key . '" => [';
                $str = self::array_to_printable_importable($value, $str);
                $str .= '],' . PHP_EOL;
            } else
            {
                $str .= '"' . $key . '" => "' . $value . '",';
            }
        }

        return $str;


    }


}