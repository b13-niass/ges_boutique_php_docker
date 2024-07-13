<?php

namespace Boutique\Core;

class Container{

    private $registery = [];

    public function set(string $name, \Closure $func): void{
        $this->registery[$name] = $func;
    }

    public function get(string $class_name): object
    {
        if (isset($this->registery[$class_name]) && !empty($this->registery[$class_name])) {
            return $this->registery[$class_name]();
        }

        $reflector = new \ReflectionClass($class_name);
        if (!$reflector->isInstantiable()) {
            throw new \Exception("Class {$class_name} is not instantiable");
        }
        $constructor = $reflector->getConstructor();
        if ($constructor === null) {
            return $reflector->newInstance();
        }
        $dependencies = [];
        foreach ($constructor->getParameters() as $parameter) {
            $type = $parameter->getType();
            $dependencies [] = $this->get($type->getName());
        }
//        dd($dependencies);
        return new $class_name(...$dependencies);
    }
}