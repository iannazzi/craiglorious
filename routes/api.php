<?php

use Illuminate\Http\Request;



$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api)
{
    $api->group(['namespace' => 'App\Http\Controllers', 'middleware' => '\Barryvdh\Cors\HandleCors::class'], function ($api)
    {
        $api->post('login', 'Auth\LoginController@jwtAuthenticate');
        //$api->post('logint', 'Auth\LoginController@me');


        $api->group(['middleware' => ['CheckCompany', 'jwt.auth']], function ($api)
        {

            $api->get('users/me', 'AuthController@me');
            $api->get('validate_token', 'AuthController@validateToken');


            $api->get('dashboard', 'DashboardController@index');
        });

//        $api->group(['protected' => true, 'middleware' => ['jwt.refresh']], function ($api)
//        {
//
//        });

    });
});
