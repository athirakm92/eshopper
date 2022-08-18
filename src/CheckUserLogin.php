<?php

namespace Eshop;

class CheckUserLogin
{
    private $dbconnection;

    public function __construct()
    {
        $this->dbconnection = new Database();
    }

    public function checkUser($email, $password)
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
