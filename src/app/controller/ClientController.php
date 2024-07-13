<?php

namespace Boutique\App\Controller;

use Boutique\Core\Controller;
use Boutique\Core\Impl\IAuthorize;
use Boutique\Core\Impl\IFile;
use Boutique\Core\Impl\ISession;
use Boutique\Core\Impl\IValidator;

class ClientController extends Controller
{
    public function __construct(IValidator $validator, ISession $session, IFile $file, IAuthorize $authorize)
    {
        parent::__construct($validator, $session, $file, $authorize);
    }
}
