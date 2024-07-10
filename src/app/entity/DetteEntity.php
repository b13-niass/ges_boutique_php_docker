<?php

namespace Boutique\App\Entity;

use Boutique\Core\Entity\Entity;

class DetteEntity extends Entity
{
    private int $id;
    private int $client_id = 0;
    private int $utilisateur_id = 0;
    private string $date;
    private string $etat;

    private float $total_dette = 0;
    private float $montant_verse = 0;
}
