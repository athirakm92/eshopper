<?php

namespace Eshop\Models;

class User extends Database
{
    private $dbconnection;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertUser($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode("', '", $data);

        $insertquery = $this->queryDB("INSERT INTO `users`($columns) VALUES ('$values')");

        return $this->lastInsertId();
    }
}
