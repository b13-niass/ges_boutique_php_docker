<?php
namespace Boutique\Core\Impl;

use Boutique\Core\Container;

Interface IServicesProvider{
    public function register(Container $container, array $services);
}