<?php

namespace Boutique\Core;

use Boutique\App\App;
use Boutique\App\Controller\Error\ErrorController;
use Boutique\App\Controller\Error\HttpCode;
use Boutique\Core\Impl\IRoute;

class Routes implements IRoute
{
    private $getRoutes = [];
    private $postRoutes = [];
    private static $middlewares = [];


    public function addGetRoute($route, $target)
    {
        $this->getRoutes[$route] = $target;
        return $this;
    }

    public function addPostRoute($route, $target)
    {
        $this->postRoutes[$route] = $target;
        return $this;
    }

    public function getGetRoutes()
    {
        return $this->getRoutes;
    }

    public function getPostRoutes()
    {
        return $this->postRoutes;
    }

    public function middleware($middleware)
    {
        $lastRoute = end($this->getRoutes) ? key($this->getRoutes) : key($this->postRoutes);
        self::$middlewares[$lastRoute] = $middleware;
        return $this;
    }


    public function dispatch($uri, $method)
    {
        $routes = $method === 'POST' ? $this->postRoutes : $this->getRoutes;
//        dd(self::$middlewares);
        foreach ($routes as $route => $target) {
            $pattern = preg_replace('/\{[a-zA-Z]+\}/', '([a-zA-Z0-9_]+)', $route);
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches);
//                    dd(self::$middlewares);
                if (isset(self::$middlewares[$route])) {
                    $middleware = self::$middlewares[$route];
                    $middlewareInstance = App::getInstance()->getContainer()->get($middleware);
                    if (!$middlewareInstance->handle()) {
                        $errorController = App::getInstance()->getContainer()->get(ErrorController::class);
                        $errorController->loadView(HttpCode::Code403);
                        exit();
                    }
                }

                if (is_callable($target)) {
                    return call_user_func_array($target, $matches);
                }

                if (is_array($target) && isset($target['controller']) && isset($target['action'])) {
                    $controllerName = $target['controller'];
                    $actionName = $target['action'];
                    try {
                        $reflectionClass = new \ReflectionClass($controllerName);

                        if ($reflectionClass->isInstantiable()) {

                            $controller = App::getInstance()->getContainer()->get($controllerName);

                            if ($reflectionClass->hasMethod($actionName)) {
                                $reflectionMethod = $reflectionClass->getMethod($actionName);

                                if ($reflectionMethod->isPublic()) {
                                    return $reflectionMethod->invokeArgs($controller, $matches);
                                } else {
                                    throw new \Exception("Method {$actionName} is not public in controller {$controllerName}");
                                }
                            } else {
                                throw new \Exception("Action {$actionName} not found in controller {$controllerName}");
                            }
                        } else {
                            throw new \Exception("Controller class {$controllerName} is not instantiable");
                        }
                    } catch (\ReflectionException $e) {
                        throw new \Exception("Controller class {$controllerName} does not exist");
                    }
                }

                throw new \Exception("Invalid route target for route {$route}");
            }
        }
        $errorController = App::getInstance()->getContainer()->get(ErrorController::class);
        $errorController->loadView(HttpCode::Code404);
        exit();
    }
}
