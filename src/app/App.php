<?php

namespace Boutique\App;

use Boutique\Core\Authorize;
use Boutique\Core\Database\MysqlDatabase;
use Boutique\Core\FIles;
use Boutique\Core\Security\SecurityDatabase;
use Boutique\Core\Session;
use Boutique\Core\Validator;

class App
{

    private static ?App $instance = null;
    private static ?MysqlDatabase $database = null;
    private static ?SecurityDatabase $securityDatabase = null;
    private static ?Session $session = null;
    private static ?Validator $validator = null;
    private static ?FIles $fileUploadSystem = null;
    public static ?Authorize $authorize = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    public static function getDatabase()
    {
        if (self::$database == null) {
            self::$database = new MysqlDatabase($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
        }
        return self::$database;
    }

    public static function getSecurityDatabase()
    {
        if (self::$securityDatabase == null) {
            self::$securityDatabase = new SecurityDatabase(self::getDatabase());
        }
        return self::$securityDatabase;
    }

    public static function getFileUploadSystem()
    {
        if (self::$fileUploadSystem == null) {
            self::$fileUploadSystem = new FIles();
        }
        return self::$fileUploadSystem;
    }

    public static function getSession(){
        if(self::$session == null){
            self::$session = new Session();
        }
        return self::$session;
    }

    public static function getValidator(){
        if(self::$validator == null){
            self::$validator = new Validator();
        }
        return self::$validator;
    }
    public static function getAuthorize(){
        if(self::$authorize == null){
            self::$authorize = new Authorize();
        }
        return self::$authorize;
    }

    public function getModel(string $modelName)
    {
        $modelName .= 'Model';
        $class = "Boutique\\App\\Model\\{$modelName}";
        $reflectionClass = new \ReflectionClass($class);
        $object = $reflectionClass->newInstance();

        $setTableMethod = $reflectionClass->getMethod('setTable');
        $setTableMethod->invoke($object);

        $setDatabaseMethod = $reflectionClass->getMethod('setDatabase');
        $setDatabaseMethod->invoke($object, self::getDatabase());

        $setTableMethod = $reflectionClass->getMethod('setEntity');
        $setTableMethod->invoke($object);

        return $object;
    }
}
