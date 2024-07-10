<?php

namespace Boutique\Core\Entity;

abstract class Entity
{

    public function __set($name, $value)
    {
        $reflectionClass = new \ReflectionClass($this);
        if ($reflectionClass->hasProperty($name)) {
            $reflectionProperty = $reflectionClass->getProperty($name);
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this, $value);
            return $this;
        }
        // return $this;
    }

    public function __get($name)
    {
        $reflectionClass = new \ReflectionClass($this);
        if ($reflectionClass->hasProperty($name)) {
            $reflectionProperty = $reflectionClass->getProperty($name);
            $reflectionProperty->setAccessible(true);
            return $reflectionProperty->getValue($this);
        }
    }

    public function toArray(){
        $reflectionClass = new \ReflectionClass($this);
        $properties = $reflectionClass->getProperties();

        $data = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $data[$property->getName()] = $property->getValue($this);
        }

        return $data;
    }

}
