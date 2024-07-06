<?php
namespace Boutique\Core\Entity;

class Entity{
    
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
    
}
