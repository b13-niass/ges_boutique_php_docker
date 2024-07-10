<?php
namespace Boutique\App\Model;

use Boutique\App\Entity\ArticleEntity;
use Boutique\Core\Model\Model;

class PanierModel extends Model{
    private $articles = [];

    public function push(ArticleEntity $article){
        $articles[] = $article;
    }

    public function getArticles(){
        return $this->articles;
    }

}