<?php
namespace Boutique\Core;

class Route
{
    private static $getRoutes = [];
    private static $postRoutes = [];

    public function __construct()
    {
        
    }

    public static function get($uri, $action)
    {
        self::$getRoutes[$uri] = $action;
    }

    public static function post($uri, $action)
    {
        self::$postRoutes[$uri] = $action;
    }

    public static function resolve()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if ($requestMethod === 'GET' && isset(self::$getRoutes[$requestUri])) {
            $action = self::$getRoutes[$requestUri];
        } elseif ($requestMethod === 'POST' && isset(self::$postRoutes[$requestUri])) {
            $action = self::$postRoutes[$requestUri];
        } else {
            throw new \Exception("Route not found.");
        }

        if (is_array($action)) {
            $controllerClass = $action[1];
            $method = $action[0];
            if (class_exists($controllerClass) && method_exists($controllerClass, $method)) {
                $controller = new $controllerClass();
                $controller->$method();
            } else {
                throw new \Exception("Controller or method not found.");
            }
        } else {
            throw new \Exception("Invalid action.");
        }
    }
}
?>
