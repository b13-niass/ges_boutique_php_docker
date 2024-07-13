<?php

namespace Boutique\App\Controller;

use Boutique\App\App;
use Boutique\Core\Controller;
use Boutique\Core\Impl\IAuthorize;
use Boutique\Core\Impl\IFile;
use Boutique\Core\Impl\ISession;
use Boutique\Core\Impl\IValidator;
use Boutique\Core\Security\SecurityDatabase;

class SecurityController extends Controller
{
//    private SecurityDatabase $securityDatabase;

    public function __construct(IValidator $validator, ISession $session, IFile $file, IAuthorize $authorize)
    {
        parent::__construct($validator, $session, $file, $authorize);
//        $this->securityDatabase = App::getSecurityDatabase();
    }

    public function login()
    {
    }
}
