<?php

namespace Boutique\App\Entity;

use Boutique\Core\Entity\Entity;

class DetailDetteEntity extends Entity
{
    private int $id;
    private int $dette_id;
    private int $article_id;
    private float $prix;
    private int $qte;
}
