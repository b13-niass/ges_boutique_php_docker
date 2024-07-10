<?php

namespace Boutique\Core\Model;

use Boutique\Core\Database\MysqlDatabase;
use \PDO;

abstract class Model
{

    protected string $table;
    protected static string $table_static;
    protected MysqlDatabase $database;
    protected static MysqlDatabase $database_static;

    public function setTable()
    {
        $className = (new \ReflectionClass($this))->getShortName();
        if (substr($className, -5) === 'Model') {
            $className = substr($className, 0, -5);
        }
        $this->table = strtolower($className) . "s";
        static::$table_static = strtolower($className) . "s";
    }

    public static function getTable()
    {
        return self::$table_static;
    }

    public function getEntityName()
    {
        $className = (new \ReflectionClass($this))->getShortName();
        if (substr($className, -5) === 'Model') {
            $className = substr($className, 0, -5);
        }
        $entityName = ucfirst($className) . "Entity";

        return "Boutique\\App\\Entity\\{$entityName}";
    }

    public static function getEntityNameStatic()
    {
        $className = (new \ReflectionClass(static::class))->getShortName();
        if (substr($className, -5) === 'Model') {
            $className = substr($className, 0, -5);
        }
        $entityName = ucfirst($className) . "Entity";

        return "Boutique\\App\\Entity\\{$entityName}";
    }

    public function all()
    {
        return $this->query("SELECT * FROM {$this->table}", $this->getEntityName());
    }


    public function find(array $data)
    {
        $key = array_keys($data)[0];

        return $this->query(
            "SELECT * FROM {$this->table} WHERE {$key} = :{$key}",
            $this->getEntityName(),
            $data,
            true
        );
    }

    public function query(string $sql, string $className, array $params = [], bool $single = false)
    {
        if (count($params) == 0) {
            $result = $this->database->query($sql, $className, $single);
        } else {
            $result =  $this->database->prepare($sql, $params, $className, $single);
        }
        return $result;
    }

    public function save(array $params)
    {
        $stringInto = [];
        $stringValues = [];

        foreach ($params as $key => $value) {
            $stringInto[] = $key;
            $stringValues[] = ":{$key}";
        }

        $into = implode(', ', $stringInto);
        $values = implode(', ', $stringValues);

        $sql = "INSERT INTO {$this->table} ({$into}) VALUES ({$values})";
        // dd($sql);
        return $this->query($sql, $this->getEntityName(), $params);
    }

    public function delete(int $id)
    {
        return $this->query(
            "DELETE FROM $this->table WHERE id = :id",
            $this->getEntityName(),
            ['id' => $id]
        );
    }

    public static function update(array $data)
    {
        $setParts = [];
        $params = [];

        foreach ($data as $key => $value) {
            if ($key != 'id') {
                $setParts[] = "{$key} = :{$key}";
            }
            $params[$key] = $value;
        }

        $setString = implode(', ', $setParts);
        $sql = "UPDATE " . static::$table_static . " SET {$setString} WHERE id = :id";

        // dd($sql);
        return static::$database_static->prepare($sql, $params, static::getEntityNameStatic(), false);
    }

    public function setDatabase(MysqlDatabase $database)
    {
        $this->database = $database;
        static::$database_static = $database;
    }


    public function makeTransaction(callable $transactions){
        try{
        $this->database->beginTransaction();
        $transactions();
        $this->database->commit();
        }catch(\Exception $e){
            $this->database->rollback();
            throw new \Exception('Erreur lors de la transaction');
        }

    }

    //hasOne 
    //hasMany
    //belongsToMany
    //BelongsTo
    //HasOneOrMany
    //BelongsToMany
    // transaction

}
