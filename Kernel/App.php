<?php


namespace Kernel;


use Kernel\DB\Connection;
use Kernel\DB\QueryBuilder;

class App
{
    public static $DB;
    public static $Router;


    public function __construct()
    {

        $routes = require_once __APP__ . '/config/routes.php';

        self::$Router = new Router($routes);

        self::$DB = new QueryBuilder(Connection::make());

    }

    public function render ()
    {

        $route = self::$Router->getCurrentRoute();

        if (!$route) {
            abort('Not founded', 404);
        }

        extract($route);

        /** @var $controller string */
        list($controller, $method) = explode('@', $controller);


        $controllerClass = "App\Controllers\\$controller";

        /** @var $params array */
        return (new $controllerClass)->$method($params);
    }


}