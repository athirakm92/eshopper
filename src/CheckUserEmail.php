<?php

namespace Eshop;

class CheckUserEmail
{
    private $dbconnection;

    public function __construct()
    {
        $this->dbconnection = new Database();
    }

    public function checkEmail($email)
    {
        $result = $this->dbconnection->queryDB("select id, user_uuid FROM users WHERE email='".$email."'");
        $rowcount = $this->dbconnection->lastInsertId();

        return $rowcount;
    }
}
