<?php

namespace Boutique\App\Controller;

use Boutique\App\App;
use Boutique\Core\Controller;
use Boutique\Core\Security\SecurityDatabase;

class SecurityController extends Controller
{
    private SecurityDatabase $securityDatabase;

    public function __construct()
    {
        parent::__construct();
        $this->securityDatabase = App::getSecurityDatabase();
    }

    public function login()
    {
    }
}
