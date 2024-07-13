<?php

namespace Boutique\App\Model;

use Boutique\Core\Model\Model;

class ArticleModel extends Model
{
    public function getArticleStock($id)
    {
        return $this->query("SELECT qte FROM {$this->table} WHERE id = :id", $this->getEntityName(), ['id' => $id], true);
    }

    public function dettes()
    {
        $this->belongsToMany('DetailDetteEntity', 'DetteEntity');
    }
}
