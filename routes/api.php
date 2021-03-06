<?php

use Illuminate\Http\Request;
use App\Classes\Routes\CIRoutes;


$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api)
{
    $api->group(['namespace' => 'App\Http\Controllers', 'middleware' => '\Barryvdh\Cors\HandleCors::class'], function ($api)
    {
        $api->post('login', 'Auth\LoginController@postLogin');
        $api->post('register', 'Auth\RegisterController@postRegister');

        $api->group(['middleware' => ['MyJwtMiddleWare']], function ($api)
        {
            //unrestricted authenticated user access pages

            $api->get('verify', 'Auth\AccessController@checkUserIsAuthenticated');
            $api->get('auth', 'Auth\AccessController@pageRefresh');
            $api->get('craigsocket', 'Auth\AccessController@craigSocket');

            //i think these three are dead
//            $api->get('userid', 'Auth\AccessController@userid');
//            $api->get('jwtdecode', 'Auth\AccessController@jwtdecode');
//            $api->get('updates', 'Auth\AccessController@getUpdates');
//
            $api->get('dashboard', 'DashboardController@index');
            $api->get('dashboard/cached_page_data', 'DashboardController@cachedPageData');
            $api->get('user/', 'UserController@getPreferences');
            $api->post('user/', 'UserController@postPreferences');

            $api->group(['middleware' => ['ViewAccess']], function ($api)
            {
                //restricted user access here....
                $api->get('calendar', 'CalendarController@getEvents');
//                $api->get('calendar/event_types', 'CalendarController@getEventTypes');
//                $api->post('calendar/search', 'CalendarController@search');
                $api->put('calendar', 'CalendarController@update');
                $api->delete('calendar', 'CalendarController@destroy');

                CIRoutes::addRoutes($api, 'roles');
                $api->put('roles/rights', 'RoleController@updateRights');

                $api->resource('tests', 'TestController');



                CIRoutes::addRoutes($api, 'users');
                CIRoutes::addRoutes($api, 'locations');
                CIRoutes::addRoutes($api, 'terminals');
                CIRoutes::addRoutes($api, 'printers');
                CIRoutes::addRoutes($api, 'vendors');
                CIRoutes::addRoutes($api, 'employees');
                CIRoutes::addRoutes($api, 'accounts');
                CIRoutes::addRoutes($api, 'customers');
                CIRoutes::addRoutes($api, 'schedules');


            });

        });
    });
});
