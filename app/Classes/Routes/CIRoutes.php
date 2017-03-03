<?php

namespace App\Classes\Routes;
use \Route;

class CIRoutes
{
    public static function addRoutes($name)
    {
        $n2 = ucfirst(substr($name,0,strlen($name)-1));
        Route::get($name.'/', $n2.'Controller@index');
        Route::get($name.'/create', $n2.'Controller@create');
        Route::get($name.'/{id}', $n2.'Controller@show');
        Route::post($name.'/search', $n2.'Controller@search');
        Route::put($name.'/', $n2.'Controller@update');
        Route::delete($name.'/', $n2.'Controller@destroy');
    }
}