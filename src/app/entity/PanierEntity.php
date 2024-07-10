<?php

use Boutique\Core\Entity\Entity;

class PanierEntity extends Entity
{
    private string $libelle;
    private float $prix;
    private int $qte;
    private float $montant;
}
