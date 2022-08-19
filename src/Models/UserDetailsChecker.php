<?php

namespace Eshop\Models;

class UserDetailsChecker
{
    private $dbconnection;

    public function __construct()
    {
        $this->dbconnection = new Database();
    }

    public function checkUserEmail($email)
    {
        $result = $this->dbconnection->queryDB("select id, user_uuid FROM users WHERE email='".$email."'");
        $rowcount = $this->dbconnection->lastInsertId();

        return $rowcount;
    }

    public function checkUserEmailAndPassword($email, $password)
    {
        $result = $this->dbconnection->queryDB("select id, user_uuid FROM users WHERE email='".$email."' and password='".$password."'");
        $userinfo = [];
        $rowcount = $result->rowCount();

        if ($rowcount == 0) {
            return $userinfo;
        } else {
            $userinfo = $result->fetch();

            return $userinfo;
        }
    }
}
