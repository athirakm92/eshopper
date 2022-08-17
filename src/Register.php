<?php

namespace Eshop;

class Register
{
    private $users;

    public function __construct()
    {
        $this->users = new Users();
    }

    public function userRegister($data)
    {
        $result = ['error' => '', 'success' => ''];

        $email = $data['email'];
        $password = $data['password'];
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $address = $data['address'];
        $phonenumber = $data['phonenumber'];
        if ($email == '' || $password == '' || $firstname == '' || $lastname == '' || $address == '' || $phonenumber == '') {
            $result['error'] = 'Please fill fields';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result['error'] = 'Invalid email format';
        } else {
            $rescheckemail = $this->users->checkEmail($email);
            if ($rescheckemail == 0) {
                $password = md5($password);
                $uuid = uniqid();
                $data = [
                    'email' => $email,
                    'user_uuid' => $uuid,
                    'password' => $password,
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'address' => $address,
                    'phone_number' => $phonenumber,
                ];

                $resultinsert = $this->users->insertUser($data);
                if (empty($resultinsert)) {
                    $result['error'] = 'An error occured';
                } else {
                    $result['success'] = 'Successfully added';
                    $_SESSION['userid'] = $resultinsert;
                }
            } else {
                $result['error'] = 'Email already exist';
            }
        }

        return $result;
    }
}
