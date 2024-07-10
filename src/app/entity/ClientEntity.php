<?php

namespace Boutique\App\Entity;

use Boutique\Core\Entity\Entity;

class ClientEntity extends Entity
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $password;
    private string $telephone;
    private string $photo;
    private float $total_dette = 0;
    private float $montant_verse = 0;
    private float $montant_restant = 0;
}
