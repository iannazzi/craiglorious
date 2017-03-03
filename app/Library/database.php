<?php

function switchArrayFromRowFieldToFieldRows($array)
{
    $output = array();
    for($i=0;$i<sizeof($array);$i++)
    {
        foreach($array[$i] as $key => $value)
        {
            $output[$key][$i] = $array[$i][$key];
        }
    }
    return $output;
}