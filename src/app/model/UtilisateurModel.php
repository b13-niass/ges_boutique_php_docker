<?php
namespace Boutique\App\Model;
use Boutique\App\App;
use Boutique\Core\Model\Model;

class UtilisateurModel extends Model{
    
    public function dettes(){
        return $this->hasMany('DetteEntity');
    }

    public function connection($email){
        return App::getSecurityDB()->getUser($email, ['clients']);
    }

}