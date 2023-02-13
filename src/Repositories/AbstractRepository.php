<?php

namespace RandomNumbers\Repositories;

interface AbstractRepository
{
    public function getItemById(int $id);
    public function createItem(array $details);
}