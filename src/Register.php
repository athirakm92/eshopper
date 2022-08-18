<?php

namespace Eshop;

class Register
{
    private $useremail;
    private $addusers;

    public function __construct()
    {
        $this->useremail = new CheckUserEmail();
        $this->addusers = new AddUser();
    }

    public function userRegister($data)
    {
        $result = ['error' => '', 'success' => ''];
        if ($data['email'] == '' || $data['password'] == '' || $data['firstname'] == '' || $data['lastname'] == '' || $data['address'] == '' || $data['phonenumber'] == '') {
            $result['error'] = 'Please fill fields';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $result['error'] = 'Invalid email format';
        } else {
            $rescheckemail = $this->useremail->checkEmail($data['email']);
            if ($rescheckemail == 0) {
                $userdata = $this->setUserData($data);

                $resultinsert = $this->addusers->insertUser($userdata);
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

    public function setUserData($data)
    {
        $password = md5($data['password']);
        $uuid = uniqid();
        $data = [
            'email' => $data['email'],
            'user_uuid' => $uuid,
            'password' => $password,
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'address' => $data['address'],
            'phone_number' => $data['phonenumber'],
        ];

        return $data;
    }
}
