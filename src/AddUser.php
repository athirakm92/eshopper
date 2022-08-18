<?php

namespace Eshop;

class AddUser
{
    private $dbconnection;

    public function __construct()
    {
        $this->dbconnection = new Database();
    }

    public function insertUser($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode("', '", $data);

        $insertquery = $this->dbconnection->queryDB("INSERT INTO `users`($columns) VALUES ('$values')");

        return $this->dbconnection->lastInsertId();
    }
}
