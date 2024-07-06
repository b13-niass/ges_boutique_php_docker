<?php
namespace Boutique\App\Entity;
use Boutique\Core\Entity\Entity;
class PaiementEntity extends Entity{
    private int $id;
    private int $dette_id;
    private float $montant;
}