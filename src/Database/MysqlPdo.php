<?php

namespace RandomNumbers\Database;

use PDO;

class MysqlPdo
{
    private static ?self $instance = null;
    private PDO $dbms;
    private string $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;

    private function __construct()
    {
        $this->dbms = new PDO($this->dsn, DB_USERNAME, DB_PASSWORD);
    }

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new MysqlPdo();
        }

        return self::$instance;
    }

    public function fetchRow(int $id, string $tableName)
    {
        $preparedQuery = "SELECT * FROM $tableName WHERE id=?";

        $statement = $this->dbms->prepare($preparedQuery);
        $statement->bindValue(1, $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function insertRow(string $tableName, array $bindArray): int
    {
        $sql = "INSERT INTO $tableName(random_number) VALUES (?)";

        $statement = $this->dbms->prepare($sql);
        $statement->execute([$bindArray[0]]);

        return $this->dbms->lastInsertId();
    }
}