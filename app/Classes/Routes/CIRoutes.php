<?php

namespace App\Classes\Routes;
use \Route;

class CIRoutes
{
    public static function addRoutes($api, $name)
    {
        $n2 = ucfirst(substr($name,0,strlen($name)-1));
       $api->get($name.'/', $n2.'Controller@index');
       $api->get($name.'/create', $n2.'Controller@create');
       $api->get($name.'/{id}', $n2.'Controller@show');
       $api->post($name.'/search', $n2.'Controller@search');
       $api->put($name.'/', $n2.'Controller@update');
       $api->delete($name.'/', $n2.'Controller@destroy');
    }
}