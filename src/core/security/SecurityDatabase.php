<?php
namespace Boutique\Core\Security;

use Boutique\App\App;

class SecurityDatabase{
    private $database;

    public function __construct(){
        $this->database = App::getDatabase();
    }

    public function login(){

    }

    public function isLogged(): bool{
        return false;
    }

    public function getRoles(){

    }

    public function getUserLogged(){

    }
}
