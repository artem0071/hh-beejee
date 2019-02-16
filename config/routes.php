<?php

return [
    [
        'pattern' => '/',
        'method' => 'GET',
        'controller' => 'TaskController@index'
    ],
    [
        'pattern' => 'tasks',
        'method' => 'POST',
        'controller' => 'TaskController@store'
    ],
    [
        'pattern' => 'tasks/(\d+)',
        'method' => 'GET',
        'controller' => 'TaskController@show'
    ],
    [
        'pattern' => 'tasks/(\d+)',
        'method' => 'POST',
        'controller' => 'TaskController@update'
    ]
];
