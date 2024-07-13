<?php

namespace Boutique\Core\Impl;

interface IAuthorize
{
    public function saveUser();

    public function getUserLogged();

    public function isLogged();

    public function hasRole();
}