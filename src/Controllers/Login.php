<?php

namespace Eshop\Controllers;

use Eshop\Models\UserDetailsChecker;
use Eshop\Services\CommonFunctions;

class Login
{
    private $users;
    private $common;

    public function __construct()
    {
        $this->users = new UserDetailsChecker();
        $this->common = new CommonFunctions();
    }

    public function checkUserAndSetSession($data)
    {
        $result = ['error' => '', 'success' => ''];
        if ($this->common->isInputEmpty($data)) {
            $result['error'] = 'Please enter email and password';

            return $result;
        }
        if (!$this->common->isValidEmail($data['email'])) {
            $result['error'] = 'Invalid email format';

            return $result;
        }

        $password = md5($data['password']);
        $resultlogin = $this->users->checkUserEmailAndPassword($data['email'], $password);

        if (empty($resultlogin)) {
            $result['error'] = 'Invalid email and password';
        } else {
            $result['success'] = $resultlogin;
            $_SESSION['userid'] = $resultlogin['id'];
        }

        return $result;
    }
}
