<?php

namespace Boutique\Core\Impl;

use Boutique\Core\Database\MysqlDatabase;

interface IModel
{
    public function all();

    public function find(array $data);

    public function query(string $sql, string $className, array $params = [], bool $single = false);

    public function save(array $params);

    public function delete(int $id);

    public static function update(array $data);

    public function setDatabase(MysqlDatabase $database);

    public function hasMany($classMany, $tableMany = null, $foreignKeyInMany = null);

    public function belongsTo($classOne, $tableOne = null, $idInOne = null);

    public function belongsToMany($classPivot, $classTarget, $columns = []);

    public function transaction(callable $transactions);
}