<?php
use App\Classes\Routes\CIRoutes;

Route::get('/', function () {
    return view('pages.home');
});
//tenant auth routes... login, logout, and check session
Route::group([], function(){
    Route::get('check-session', ['middleware' => 'CheckSession' , 'uses' => 'Auth\LoginController@checkSession']);
    Route::get('/auth/login', ['middleware' => 'LoginAuthenticate', 'as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
    Route::post('/auth/login', ['middleware' => 'LoginAuthenticate', 'as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);

    Route::post('/auth/logout', ['middleware' => 'Logout', 'as'=>'logout', 'uses' =>    'Auth\LogoutController@postLogout']);
    Route::get('/auth/logout', ['middleware' => 'Logout', 'as'=>'logout', 'uses' =>    'Auth\LogoutController@getLogout']);



});

////DASHBOARD

Route::group(['middleware' => ['DashboardAuthenticate'],],  function () {

    Route::get('/dashboard', [ 'as' => 'dashboard', 'uses' => 'DashboardController@getIndex']);

    Route::resource('tests', 'TestController');





    CIRoutes::addRoutes('roles');
    CIRoutes::addRoutes('users');
    Route::get('user/', 'UserController@getPreferences');
    Route::post('user/', 'UserController@postPreferences');

    CIRoutes::addRoutes('locations');
    CIRoutes::addRoutes('terminals');
    CIRoutes::addRoutes('printers');


    CIRoutes::addRoutes('vendors');

    Route::get('calendar', 'CalendarController@getEvents');
    Route::get('calendar/event_types', 'CalendarController@getEventTypes');
//    Route::post('calendar', 'CalendarController@postEvents');
    Route::post('calendar/search', 'CalendarController@search');
    Route::put('calendar', 'CalendarController@update');
    Route::delete('calendar', 'CalendarController@destroy');

});



