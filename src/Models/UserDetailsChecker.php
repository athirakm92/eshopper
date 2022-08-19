<?php

namespace Eshop\Models;

class UserDetailsChecker extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkUserEmail($email)
    {
        $result = $this->queryDB("select id, user_uuid FROM users WHERE email='".$email."'");
        $rowcount = $this->lastInsertId();

        return $rowcount;
    }

    public function checkUserEmailAndPassword($email, $password)
    {
        $result = $this->queryDB("select id, user_uuid FROM users WHERE email='".$email."' and password='".$password."'");
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
