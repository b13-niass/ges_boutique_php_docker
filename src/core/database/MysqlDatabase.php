<?php

namespace Boutique\Core\Database;

use Boutique\Core\Impl\IDatabase;
use \PDO;

final class MysqlDatabase implements IDatabase
{
    private $pdo;
    // private static $instance;

    public function __construct($host, $dbname, $user, $password)
    {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $password, $options);
        } catch (\PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }

    public function prepare(
        string $sql,
        array $params,
        string $className,
        bool $single
    ) {
        $correspondingRequest = strtolower(explode(' ', $sql)[0]); //insert
        $requestListType = ['insert', 'update', 'delete'];

        $isTypeFound = array_search($correspondingRequest, $requestListType);
        // dd($isTypeFound);

        $stmt = $this->pdo->prepare($sql);
        if ($params != null) {
            foreach ($params as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
        }
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $className);

        if ($isTypeFound !== false) {
            if ($requestListType[$isTypeFound] == 'insert') {
                return $this->pdo->lastInsertId();
            } else {
                return $stmt->rowCount();
            }
        } else {
            if ($single) {
                return $stmt->fetch();
            }
            return $stmt->fetchAll();
        }
    }

    public function query(
        string $sql,
        string $className,
        bool $single
    ) {
        $stmt = $this->pdo->query($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $className);
        if ($single) {
            return $stmt->fetch();
        }
        return $stmt->fetchAll();
    }


    public function beginTransaction()
    {
        return $this->pdo->beginTransaction();
    }

    public function commit()
    {
        return $this->pdo->commit();
    }

    public function rollback()
    {
        return $this->pdo->rollBack();
    }

    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

}
