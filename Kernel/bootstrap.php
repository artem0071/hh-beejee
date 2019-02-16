<?php

require_once __APP__ . '/env.php';

require_once __APP__ .'/vendor/autoload.php';

if (!function_exists('dd')) {
    function dd()
    {
        echo '<pre>';
        array_map(function($x) {
            var_dump($x);
            echo '<br />';
        }, func_get_args());
        die;
    }
}

if (!function_exists('abort')) {
    function abort($message, $code)
    {
        throw new Exception($message, $code);
    }
}

if (!function_exists('view')) {
    function view(string $page, array $params = [])
    {
        $blade = new Jenssegers\Blade\Blade(
            __APP__ . '/resources/views',
            __APP__ . '/resources/cache'
        );


        return $blade->make($page, $params);
    }
}