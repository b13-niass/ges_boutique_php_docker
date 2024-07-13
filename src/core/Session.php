<?php

namespace Boutique\Core;

use Boutique\Core\Impl\ISession;

class Session implements ISession
{

    public function __construct()
    {
        $this->start();
    }

    public function start()
    {
        session_start();
    }

    public function close()
    {
        session_destroy();
    }
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function setArray($keyPrime, $keySecond, $value)
    {
        $_SESSION[$keyPrime][$keySecond] = $value;
    }

    public function get($key)
    {
        return $this->issetE($key) ? $_SESSION[$key] : null;
    }

    public function getJson($key)
    {
        return $this->issetE($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function issetE($key)
    {
        if (isset($_SESSION[$key])) {
            return true;
        }
        return false;
    }

    public function all()
    {
        return  $_SESSION;
    }

    public function unset($key)
    {
        // if ($this->>issetE($_SESSION[$key])) {
        unset($_SESSION[$key]);
        // return true;
        // }
        // return false;
    }


    public function saveObjectToSession($object, $sessionKey)
    {
        $reflectionClass = new \ReflectionClass($object);
        $properties = $reflectionClass->getProperties();

        $sessionData = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $sessionData[$property->getName()] = $property->getValue($object);
        }

        $this->set($sessionKey, $sessionData);
    }

    public function restoreObjectFromSession($classEntity, $sessionKey)
    {
        if (!$this->issetE($sessionKey)) {
            return null;
        }
        $classEntity = "Boutique\\App\\Entity\\{$classEntity}Entity";

        $sessionData = $_SESSION[$sessionKey];
        $reflectionClass = new \ReflectionClass($classEntity);
        $object = $reflectionClass->newInstanceWithoutConstructor();

        foreach ($sessionData as $propertyName => $value) {
            $property = $reflectionClass->getProperty($propertyName);
            $property->setAccessible(true);
            $property->setValue($object, $value);
        }

        return $object;
    }

    public function saveObjectToSessionArray($object, $sessionKey)
    {
        $reflectionClass = new \ReflectionClass($object);
        $properties = $reflectionClass->getProperties();

        $sessionData = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $sessionData[$property->getName()] = $property->getValue($object);
        }

        if (!isset($_SESSION[$sessionKey])) {
            $_SESSION[$sessionKey] = [];
        }

        $_SESSION[$sessionKey][] = $sessionData;
    }

    public function restoreObjectsFromSessionArray($classEntity, $sessionKey)
    {
        if (!$this->issetE($sessionKey)) {
            return [];
        }
        $classEntity = "Boutique\\App\\Entity\\{$classEntity}Entity";

        $sessionDataArray = $_SESSION[$sessionKey];
        $objects = [];

        foreach ($sessionDataArray as $sessionData) {
            $reflectionClass = new \ReflectionClass($classEntity);
            $object = $reflectionClass->newInstanceWithoutConstructor();

            foreach ($sessionData as $propertyName => $value) {
                $property = $reflectionClass->getProperty($propertyName);
                $property->setAccessible(true);
                $property->setValue($object, $value);
            }

            $objects[] = $object;
        }

        return $objects;
    }
}
