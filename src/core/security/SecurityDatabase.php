<?php

namespace Boutique\Core\Security;

use Boutique\Core\Database\MysqlDatabase;

class SecurityDatabase
{
    private $database;

    public function __construct(MysqlDatabase $database)
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
