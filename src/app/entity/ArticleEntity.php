<?php
namespace Boutique\App\Entity;
use Boutique\Core\Entity\Entity;

class ArticleEntity extends Entity{
    private int $id;
    private string $libelle;
    private float $prix;
    private int $qte;
    private string $reference;
    
}