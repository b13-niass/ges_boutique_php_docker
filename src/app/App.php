<?php
namespace Boutique\App;

use Boutique\Core\Container;
use Boutique\Core\Impl\IDatabase;
use Boutique\Core\Service\ServicesProvider;

class App
{
    private static ?App $instance = null;
    private ?Container $container = null;

    private function __construct()
    {
    }

    public static function getInstance(): App
    {
        if (self::$instance === null) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    public function getContainer(): Container
    {
        if ( $this->container  === null) {
            $this->container = new Container();
        }
        return $this->container;
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
        $setDatabaseMethod->invoke($object, $this->container->get(IDatabase::class));

        $setTableMethod = $reflectionClass->getMethod('setEntity');
        $setTableMethod->invoke($object);

        return $object;
    }
}

