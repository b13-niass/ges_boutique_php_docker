<?php

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
