<?php

namespace Boutique\Core\Impl;

interface IDatabase
{

    public function prepare(
        string $sql,
        array  $params,
        string $className,
        bool   $single
    );

    public function query(
        string $sql,
        string $className,
        bool   $single
    );

    public function beginTransaction();

    public function commit();

    public function rollback();

    public function getLastInsertId();
}