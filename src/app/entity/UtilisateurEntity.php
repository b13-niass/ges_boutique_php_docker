<?php
namespace Boutique\App\Entity;
use Boutique\Core\Entity\Entity;
class UtilisateurEntity extends Entity{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $password;
    private string $telephone;
    private string $photo;
    private string $role;
}