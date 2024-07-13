<?php

namespace Boutique\Core\Impl;

interface IRoute
{
    public function addGetRoute($route, $target);

    public function addPostRoute($route, $target);

    public function getGetRoutes();

    public function getPostRoutes();

    public function dispatch($uri, $method,$container);
}