<?php

namespace Eshop;

class Users
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
        $rowcount = $result->fetchColumn();
        if ($rowcount == 0) {
            return $userinfo;
        } else {
            $userinfo = $result->fetch();

            return $userinfo;
        }
    }

    public function insertUser($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode("', '", $data);

        return $this->dbconnection->queryDB("INSERT INTO `users`($columns) VALUES ('$values')");
    }

    public function checkEmail($email)
    {
        $result = $this->dbconnection->queryDB("select id, user_uuid FROM users WHERE email='".$email."'");
        $userinfo = [];
        $rowcount = $result->fetchColumn();

        return $rowcount;
    }
}
