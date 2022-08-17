<?php

namespace Eshop;

class Login
{
    public function __construct()
    {
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
            $users = new Users();
            $password = md5($password);
            $resultlogin = $users->checkUser($email, $password);
            if (empty($resultlogin)) {
                $result['error'] = 'Invalid email and password';
            } else {
                $result['success'] = $resultlogin;
            }
        }

        return $result;
    }
}
