<?php

namespace Boutique\App\Controller;

use Boutique\App\App;
use Boutique\App\Model\UtilisateurModel;
use Boutique\Core\Controller;
use Boutique\Core\Impl\IAuthorize;
use Boutique\Core\Impl\IFile;
use Boutique\Core\Impl\IPaginator;
use Boutique\Core\Impl\ISession;
use Boutique\Core\Impl\IValidator;
use Boutique\Core\Security\SecurityDatabase;

class SecurityController extends Controller
{
    private UtilisateurModel $userModel;

    public function __construct(IValidator $validator, ISession $session, IFile $file, IAuthorize $authorize, IPaginator $paginator)
    {
        parent::__construct($validator, $session, $file, $authorize,$paginator);
        $this->userModel = App::getInstance()->getModel("Utilisateur");
    }

    public function login()
    {
//        dd(password_hash("passer", PASSWORD_DEFAULT));
        $data = [];
        if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET'){
            $this->layout = "login_layout";
            if ($this->session->issetE('errors')){
                $data['errors'] = $this->session->get('errors');
                $this->session->unset('errors');
            }
            if ($this->session->issetE('emailValid')){
                $data['emailValid'] = $this->session->get('emailValid');
                $this->session->unset('emailValid');
            }
            $this->renderView('/login', $data);
        }else{
            $errors = $this->validator->validate($_POST, [
                'email' => ['required','email'],
                'password' => ['required','minLength:6']
            ]);

            if (count($errors)){
                if(!isset($errors['email'])){
                    $this->session->set('emailValid', $_POST['email']);
                }
                $this->session->set('errors', $errors);
                $this->redirect('/login');
            }else{
                $userFound = $this->userModel->connection($_POST['email']);

                if ($userFound) {
                    if (password_verify($_POST['password'], $userFound->password)) {
                        $userFound->password = "";
                        $this->session->saveObjectToSession($userFound,'userConnected');
                        if ($userFound->role == 'vendeur'){
                            $this->redirect('/dettes');
                        }
                        if ($userFound->role == 'client'){
                            $this->redirect('/client/dettes');
                        }
                    }else{
                        $data['connectionError'] = "L'email ou le mot de passe est invalide.";
                        $data['emailValid'] = $_POST['email'];

                        $this->layout = "login_layout";
                        $this->renderView('/login', $data);
                    }
                }else{
                    $data['connectionError'] = "L'email ou le mot de passe est invalide.";
                    $data['emailValid'] = $_POST['email'];

                    $this->layout = "login_layout";
                    $this->renderView('/login', $data);
                }
            }
        }
    }
}
