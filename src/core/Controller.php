<?php
namespace Boutique\Core;

class Controller{
    protected ?Session $session = null;

    public function __construct(){
        $this->session = new Session();
    }

    public function renderView($view, $data = []){
        require_once $_ENV['VIEW_DIR'] . "/partials/headers.html.php";
        require_once $_ENV['VIEW_DIR'] . "/{$view}.html.php";
        require_once $_ENV['VIEW_DIR'] . "/partials/footer.html.php";
    }

    public function redirect($url){
        header("Location: {$url}");
        exit;
    }
}
