<?php

namespace Eshop;

class Login
{
    private $users;

    public function __construct()
    {
        $this->users = new Users();
    }

    public function userLogin($data)
    {
        $email = $data['email'];
        $password = $data['password'];
        $result = ['error' => '', 'success' => ''];
        if ($email == '' || $password == '') {
            $result['error'] = 'Please enter email and password';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result['error'] = 'Invalid email format';
        } else {
            $password = md5($password);
            $resultlogin = $this->users->checkUser($email, $password);
            if (empty($resultlogin)) {
                $result['error'] = 'Invalid email and password';
            } else {
                $result['success'] = $resultlogin;
                $_SESSION['userid'] = $resultlogin['id'];
            }
        }

        return $result;
    }
}
