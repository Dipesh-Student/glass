<?php

namespace App\Controllers;

class AuthController
{
    public static function doLogin($param = array())
    {
        if (($param['username'] == "dipesh@gmail.com") && ($param['password'] == "1234")) {
            $_SESSION['user'] = true;
            header("Location: /glass/public");
        } else {
            $_SESSION['user'] = false;
            self::doLogout();
        }
    }

    public static function doLogout(){
        session_unset();
        session_destroy();
        header("Location: /glass/public");
    }
}
