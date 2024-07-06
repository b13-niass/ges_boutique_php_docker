<?php
namespace Boutique\Core;

class Session{
    
    public function __construct(){
        self::start();
    }

    public static function start(){
        session_start();
    }

    public static function close(){
        session_destroy();
    }
    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        return self::issetE($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function getJson($key){
        return self::issetE($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function issetE($key) { 
        return  isset($_SESSION[$key]);
     }

     function saveObjectToSession($object, $sessionKey) {
        $reflectionClass = new \ReflectionClass($object);
        $properties = $reflectionClass->getProperties();
    
        $sessionData = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $sessionData[$property->getName()] = $property->getValue($object);
        }
    
        self::set($sessionKey,$sessionData);
    }

    function restoreObjectFromSession($classEntity, $sessionKey) {
        if (!self::issetE($sessionKey)) {
            return null;
        }
    
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

}
