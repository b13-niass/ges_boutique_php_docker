<?php
namespace Boutique\App\Controller;

use Boutique\App\App;
use Boutique\Core\Controller;
use Boutique\Core\Session;

class BoutiquierController extends Controller{
    
    public function __construct(){
        // parent::__construct();
    }
    public function index(){
        $this->renderView('ajout_dette');
    }

    public function store(){
        $this->renderView('ajout_dette');
    }
}
