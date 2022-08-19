<?php

namespace Eshop\Services;

class CommonFunctions
{
    public function __construct()
    {
    }

    public function isInputEmpty($data)
    {
        foreach ($data as $key => $value) {
            if ($value == '') {
                return true;
            }
        }

        return false;
    }

    public function isValidEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }
}
