<?php
namespace Boutique\App\Entity;
use Boutique\Core\Entity\Entity;
class DetteEntity extends Entity{
    private int $id;
    private int $client_id;
    private int $utilisateur_id;
    private string $date;
    private string $etat;
}
