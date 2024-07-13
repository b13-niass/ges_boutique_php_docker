<?php

namespace Boutique\App;

use Boutique\Core\Database\MysqlDatabase;
use Boutique\Core\Files;
use Boutique\Core\Security\SecurityDatabase;
use Boutique\Core\Session;
use Boutique\Core\Validator;

class App
{

    private static ?App $instance = null;
    private static ?MysqlDatabase $database = null;
    private static ?SecurityDatabase $securityDatabase = null;
    protected ?Session $session = null;
    protected ?Validator $validator = null;
    protected ?Files $fileUploadSystem = null;

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
            self::$fileUploadSystem = new Files();
        }
        return self::$fileUploadSystem;
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
