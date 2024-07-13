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

    public function addGetRoute($route, $target)
    {
        $this->getRoutes[$route] = $target;
    }

    public function addPostRoute($route, $target)
    {
        $this->postRoutes[$route] = $target;
    }

    public function getGetRoutes()
    {
        return $this->getRoutes;
    }

    public function getPostRoutes()
    {
        return $this->postRoutes;
    }

    public function dispatch($uri, $method)
    {
        $routes = $method === 'POST' ? $this->postRoutes : $this->getRoutes;
        foreach ($routes as $route => $target) {
            $pattern = preg_replace('/\{[a-zA-Z]+\}/', '([a-zA-Z0-9_]+)', $route);
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches);

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
//                            $controller = $reflectionClass->newInstance(
//                                App::getValidator(),
//                                App::getSession(),
//                                App::getFileUploadSystem(),
//                                App::getAuthorize()
//                            );

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

        ErrorController::loadView(HttpCode::Code404);
        exit();
    }
}
