<?php

namespace Boutique\App;

use Boutique\Core\Database\MysqlDatabase;
use Boutique\Core\Security\SecurityDatabase;

class App
{

    private static ?App $instance = null;
    private static ?MysqlDatabase $database = null;
    private static ?SecurityDatabase $securityDatabase = null;

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

        return $object;
    }
}
