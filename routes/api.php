<?php

use Illuminate\Http\Request;



$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api)
{
    $api->group(['namespace' => 'App\Http\Controllers', 'middleware' => '\Barryvdh\Cors\HandleCors::class'], function ($api)
    {
        $api->post('login', 'Auth\LoginController@jwtAuthenticate');
        $api->get('login/validate', 'Auth\LoginController@validateToken');
        //$api->post('logint', 'Auth\LoginController@me');


        $api->group(['middleware' => ['CheckCompany', 'jwt.auth']], function ($api)
        {


            $api->get('validate_token', 'Auth\LoginController@validateToken');
            $api->get('dashboard', 'DashboardController@index');
            $api->get('dashboard/page_data', 'DashboardController@pageData');


            $api->get('calendar', 'CalendarController@getEvents');
            $api->get('calendar/event_types', 'CalendarController@getEventTypes');
//    $api->post('calendar', 'CalendarController@postEvents');
            $api->post('calendar/search', 'CalendarController@search');
            $api->put('calendar', 'CalendarController@update');
            $api->delete('calendar', 'CalendarController@destroy');






        });

//        $api->group(['protected' => true, 'middleware' => ['jwt.refresh']], function ($api)
//        {
//
//        });

    });
});
