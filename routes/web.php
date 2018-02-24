<?php

Route::get('/', function () {
    return view('pages.api');
});

Route::get('/test', function () {
    $data = [
        'event' => 'UserSignedUp',
        'data' => [
            'username' => 'JohnDoe'
        ]
    ];
    \Redis::publish('test-channel',json_encode($data));
    return 'done';
});
