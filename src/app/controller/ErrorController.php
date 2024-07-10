<?php

namespace Boutique\App\Controller;

use Boutique\App\App;
use Boutique\Core\Controller;

class ErrorController extends Controller
{
    public function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        require_once $_ENV['VIEW_DIR'] . '/erreur404.html.php';
    }

    public function forbidden()
    {
    }
}
