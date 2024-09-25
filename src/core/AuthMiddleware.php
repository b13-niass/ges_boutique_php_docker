<?php

namespace Boutique\Core;

use Boutique\App\App;
use Boutique\Core\Impl\IMiddleware;

class AuthMiddleware implements IMiddleware
{
    public function handle()
    {
//        $session = App::getInstance()->getContainer()->get(Session::class);
//        if ($session->isLoggedIn()) {
            return true;
//        }
//
//        header('Location: /login');
//        exit;
    }
}
