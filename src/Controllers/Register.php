<?php

namespace Eshop\Controllers;

use Eshop\Models\User;
use Eshop\Models\UserDetailsChecker;
use Eshop\Services\CommonFunctions;

class Register
{
    private $userDetails;
    private $users;
    private $common;

    public function __construct()
    {
        $this->userDetails = new UserDetailsChecker();
        $this->users = new User();
        $this->common = new CommonFunctions();
    }

    public function userRegister($data)
    {
        $result = ['error' => '', 'success' => ''];

        $resultValidateRegister = $this->validateUserRegistration($data);
        if (!empty($resultValidateRegister)) {
            $result['error'] = $resultValidateRegister;

            return $result;
        }

        $userData = $this->setUserData($data);

        $resultUserID = $this->users->insertUser($userData);
        if (empty($resultUserID)) {
            $result['error'] = 'An error occured';
        } else {
            $result['success'] = 'Successfully added';
            $_SESSION['userid'] = $resultUserID;
        }

        return $result;
    }

    public function validateUserRegistration($data)
    {
        if ($this->common->isInputEmpty($data)) {
            return 'Please enter email and password';
        }
        if (!$this->common->isValidEmail($data['email'])) {
            return 'Invalid email format';
        }
        $resultCheckEmail = $this->userDetails->checkUserEmail($data['email']);
        if ($resultCheckEmail > 0) {
            return 'Email already exist';
        }

        return '';
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
