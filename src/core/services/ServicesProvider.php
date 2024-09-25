<?php
namespace Boutique\Core\Service;

use Boutique\Core\Container;
use Boutique\Core\Impl\IAuthorize;
use Boutique\Core\Impl\IDatabase;
use Boutique\Core\Impl\IFile;
use Boutique\Core\Impl\IServicesProvider;
use Boutique\Core\Impl\ISession;
use Boutique\Core\Impl\IValidator;

class ServicesProvider implements IServicesProvider
{
    public function register(Container $container, array $services)
    {
//        dd($services);
        foreach ($services as $serviceName => $serviceClass) {
            try {
                $container->set($serviceName, function () use ($serviceClass, $serviceName){
                    $reflectionClass = new \ReflectionClass($serviceClass);

                    if ($reflectionClass->isInstantiable()) {

                        if ($serviceName === 'Boutique\Core\Impl\IDatabase') {
                            $params = [dbHost, dbName, dbUser, dbPassword];
                            $instance = $reflectionClass->newInstanceArgs($params);
                        } else {
                            $instance = $reflectionClass->newInstance();
                        }
                        return $instance;
                    } else {
                        echo "La classe {$serviceClass} n'est pas instanciable pour le service {$serviceName}.<br>";
                    }
                });
            } catch (\ReflectionException $e) {
                echo "Erreur lors de la réflexion pour le service {$serviceName}: " . $e->getMessage() . "<br>";
            }
        }
    }

}
