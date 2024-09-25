<?php

namespace Boutique\App\Controller;

use Boutique\App\App;
use Boutique\Core\Controller;
use Boutique\Core\Impl\IAuthorize;
use Boutique\Core\Impl\IFile;
use Boutique\Core\Impl\IPaginator;
use Boutique\Core\Impl\ISession;
use Boutique\Core\Impl\IValidator;

class ClientController extends Controller
{
    private $clientModel;

    public function __construct(IValidator $validator, ISession $session, IFile $file, IAuthorize $authorize, IPaginator $paginator)
    {
        parent::__construct($validator, $session, $file, $authorize,$paginator);
        $this->clientModel = App::getInstance()->getModel('Client');
    }

    public function index(){
        $data = [];
        if ($this->session->issetE("userConnected")){
            $data['userConnected'] = $this->session->restoreObjectFromSession('Utilisateur', 'userConnected');
        }
        $this->renderView('/client/index_dette', $data);
    }
}
