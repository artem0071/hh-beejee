<?php


namespace Kernel;


class Router
{

    protected $method;
    protected $routes = [];

    public $params = [];

    public $data = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;

        $this->setData();
    }

    public function getCurrentUri()
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (strstr($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        return trim($uri, '/') ?: '/';
    }

    public function getCurrentMethod()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];

        return $this->method;
    }

    public function getCurrentRoute()
    {
        $method = $this->getCurrentMethod();

        $uri = $this->getCurrentUri();

        $controller = null;

        array_map(function ($route) use ($method, $uri, &$controller) {



            if ($method == $route['method'] && preg_match_all('#^'.$route['pattern'].'$#', $uri, $matches, PREG_OFFSET_CAPTURE)) {

                $matches = array_slice($matches, 1);

                $this->params = $this->getCurrentParams($matches);

                $controller = [
                    'params' => $this->params,
                    'uri' => $uri,
                    'controller' => $route['controller']
                ];

            }

        }, $this->routes);

        return $controller;
    }

    public function getCurrentParams($matches)
    {
        return array_map(function ($match, $index) use ($matches) {
            if (isset($matches[$index + 1]) && isset($matches[$index + 1][0]) && is_array($matches[$index + 1][0])) {
                return trim(substr($match[0][0], 0, $matches[$index + 1][0][1] - $match[0][1]), '/');
            }
            else {
                return isset($match[0][0]) ? trim($match[0][0], '/') : null;
            }
        }, $matches, array_keys($matches));
    }

    public function setData()
    {
        $method = $this->method ?: $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'GET':
                $this->data = (array)$_GET;
                break;
            case 'POST':
                if (count($_POST)) {
                    if (count($_FILES))
                        $this->data = (array)array_merge($_POST, $_FILES);
                    else
                        $this->data = (array)$_POST;
                } else
                    $this->data = (array)json_decode(file_get_contents("php://input"));
                break;
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                $this->data =
                    (array)json_decode(file_get_contents("php://input"));
                break;
        }
    }

    public function checkData(array $dataToCheck = [])
    {
        return array_column(array_map(function ($param) {

            if (!key_exists($param, $this->data)) {
                abort('Need param: ' . $param, 400);
            }

            return [
                'id' => $param,
                'value' => $this->data[$param]
            ];

        }, $dataToCheck), 'value', 'id');
    }

}