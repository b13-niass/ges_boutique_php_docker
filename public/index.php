<?php
function dd($data){
    echo "<pre >";
    var_dump($data);
    echo "</pre>";
    die();
}

require_once dirname(__DIR__)."/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// $dbHost = $_ENV['DB_HOST'];


require_once "../router/router.php";
