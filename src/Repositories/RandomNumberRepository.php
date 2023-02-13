<?php

namespace RandomNumbers\Repositories;

use RandomNumbers\Database\MysqlPdo;

class RandomNumberRepository implements AbstractRepository
{

    public function getItemById(int $id)
    {
        $dbms = MysqlPdo::getInstance();

        return $dbms->fetchRow($id, 'numbers');
    }

    public function createItem(array $details): ?int
    {
        if (!isset($details['number'])) {
            return null;
        }

        $bindArray[] = $details['number'];
        $dbms = MysqlPdo::getInstance();

        return $dbms->insertRow('numbers', $bindArray);
    }
}