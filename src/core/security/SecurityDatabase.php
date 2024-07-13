<?php

namespace Boutique\Core\Security;

use Boutique\Core\Database\MysqlDatabase;
use Boutique\Core\Impl\IDatabase;

class SecurityDatabase
{
    private $database;

    public function __construct(IDatabase $database)
    {
        $this->database = $database;
    }

    public function login()
    {
    }

    public function isLogged(): bool
    {
        return false;
    }

    public function getRoles()
    {
    }

    public function getUserLogged()
    {
    }
}
