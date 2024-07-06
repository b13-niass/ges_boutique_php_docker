<?php
namespace Boutique\App;

use Boutique\Core\Database\MysqlDatabase;
class App{
    
    private static ?App $instance = null;
    private static ?MysqlDatabase $database = null;

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new App();
        }
        return self::$instance;
    }

    public static function getDatabase(){
        if(self::$database == null){
            self::$database = new MysqlDatabase($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
        }
        return self::$database;
    }

    public function getModel(string $modelName) {
        $modelName .='Model';
        $class = "Boutique\\App\\Model\\{$modelName}";
        $object = new $class();
        $object->setTable();
        $object->setDatabase(self::getDatabase());
        return $object;
    }

    public function notFound(){

    }

    public function forbidden(){

    }
}
