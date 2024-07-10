<?php

namespace Boutique\Core;

class Session
{

    public function __construct()
    {
        self::start();
    }

    public static function start()
    {
        session_start();
    }

    public static function close()
    {
        session_destroy();
    }
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function setArray($keyPrime, $keySecond, $value)
    {
        $_SESSION[$keyPrime][$keySecond] = $value;
    }

    public static function get($key)
    {
        return self::issetE($key) ? $_SESSION[$key] : null;
    }

    public static function getJson($key)
    {
        return self::issetE($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function issetE($key)
    {
        if (isset($_SESSION[$key])) {
            return true;
        }
        return false;
    }

    public static function all()
    {
        return  $_SESSION;
    }

    public static function unset($key)
    {
        // if (self::issetE($_SESSION[$key])) {
        unset($_SESSION[$key]);
        // return true;
        // }
        // return false;
    }


    public static function saveObjectToSession($object, $sessionKey)
    {
        $reflectionClass = new \ReflectionClass($object);
        $properties = $reflectionClass->getProperties();

        $sessionData = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $sessionData[$property->getName()] = $property->getValue($object);
        }

        self::set($sessionKey, $sessionData);
    }

    public static function restoreObjectFromSession($classEntity, $sessionKey)
    {
        if (!self::issetE($sessionKey)) {
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

    public static function saveObjectToSessionArray($object, $sessionKey)
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

    public static function restoreObjectsFromSessionArray($classEntity, $sessionKey)
    {
        if (!self::issetE($sessionKey)) {
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
