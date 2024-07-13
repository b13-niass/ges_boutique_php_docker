<?php

namespace Boutique\App\Controller\Error;

// use Boutique\App\App;
use Boutique\Core\Controller;

class ErrorController extends Controller
{
    // public function notFound()
    // {
    //     header("HTTP/1.0 404 Not Found");
    //     require_once $_ENV['VIEW_DIR'] . '/erreur404.html.php';
    // }

    // public function forbidden()
    // {
    // }

    public static function loadView(HttpCode $code)
    {

        $instance = new self();

        $instance->layout = "error_layout";

        match ($code) {
            HttpCode::Code404 => $instance->renderView('/errors/erreur404'),
            HttpCode::Code403 => $instance->renderView('/errors/erreur403')
        };
    }
}
