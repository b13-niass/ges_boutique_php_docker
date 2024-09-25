<?php

use Boutique\Core\Service\ServicesProvider;
use Symfony\Component\Yaml\Yaml;
use \Boutique\App\App;

/** Chargement du fichier .env **/
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('dbHost', $_ENV['DB_HOST']);
define('dbName', $_ENV['DB_NAME']);
define('dbUser', $_ENV['DB_USER']);
define('dbPassword', $_ENV['DB_PASS']);
define('root', $_ENV['ROOT']);
define('webRoot', $_ENV['WEBROOT']);
define('viewDir', $_ENV['VIEW_DIR']);
define('uploadDir', $_ENV['UPLOAD_DIR']);
define('assetsPath', $_ENV['ASSETS_PATH']);

/** Quelque fonction utilitaire **/


function dd($data)
{
    echo "<pre >";
    var_dump($data);
    echo "</pre>";
    die();
}

function removeTrailingSlash($string)
{
    return rtrim($string, '/');
}

function replaceMultipleSlashes($url)
{
    return removeTrailingSlash(preg_replace('#/+#', '/', $url));
}

function extractServiceClasses(array $config): array
{
    $serviceClasses = [];

    if (isset($config['services'])) {
        foreach ($config['services'] as $serviceKey => $serviceConfig) {
            if (isset($serviceConfig['class'])) {
                $serviceClasses[$serviceKey] = $serviceConfig['class'];
            }
        }
    }

    return $serviceClasses;
}
/** Chargement du fichier Yaml qui contient les config **/

$config = Yaml::parseFile("../config/config.yml");

$services = extractServiceClasses($config);

$provider = new ServicesProvider();

//$numbers = [1, 2, 3, 4, 5];
//
//$squares = array_map(fn($number) => $number * $number, $numbers);
//
//print_r($squares);

$provider->register(App::getInstance()->getContainer(), $services);

//define('SERVICE_YAML', $services);

//dd($services);

