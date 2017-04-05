<?php

use Illuminate\Http\Request;
use App\Classes\Routes\CIRoutes;


$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api)
{
    $api->group(['namespace' => 'App\Http\Controllers', 'middleware' => '\Barryvdh\Cors\HandleCors::class'], function ($api)
    {
        $api->post('login', 'Auth\LoginController@postLogin');
        //$api->get('login/validate', 'Auth\LoginController@validateToken');
        //$api->post('logint', 'Auth\LoginController@me');


        $api->group(['middleware' => ['MyJwtMiddleWare']], function ($api)
        {

//            dd(request());
            $api->get('auth', 'Auth\AccessController@checkUserIsAuthenticated');




            $api->get('dashboard', 'DashboardController@index');
            $api->get('dashboard/cached_page_data', 'DashboardController@cachedPageData');


            $api->get('calendar', 'CalendarController@getEvents');
            $api->get('calendar/event_types', 'CalendarController@getEventTypes');
//    $api->post('calendar', 'CalendarController@postEvents');
            $api->post('calendar/search', 'CalendarController@search');
            $api->put('calendar', 'CalendarController@update');
            $api->delete('calendar', 'CalendarController@destroy');

            CIRoutes::addRoutes($api, 'roles');
            $api->put('roles/rights', 'RoleController@updateRights');
//            $api->post('roles/search', 'RoleController@search');



            $api->resource('tests', 'TestController');


            $api->get('user/', 'UserController@getPreferences');
            $api->post('user/', 'UserController@postPreferences');

            CIRoutes::addRoutes($api, 'users');
            CIRoutes::addRoutes($api, 'locations');
            CIRoutes::addRoutes($api, 'terminals');
            CIRoutes::addRoutes($api, 'printers');
            CIRoutes::addRoutes($api, 'vendors');
            CIRoutes::addRoutes($api, 'employees');



            return response()->json(['error' => 'not found'], 404);



        });

//        $api->group(['protected' => true, 'middleware' => ['jwt.refresh']], function ($api)
//        {
//
//        });

    });
});
