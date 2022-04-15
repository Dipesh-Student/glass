<?php

namespace App\Controllers;

class AuthController
{
    public static function doLogin($param = array())
    {
        $username = $param['username'];
        $password = $param['password'];
        $_SESSION['user'] = false;
        foreach (self::userdb('../d.json') as $key => $value) {
            if (($param['username'] == $key) && ($param['password'] == $value)) {
                $_SESSION['user'] = true;
                $_SESSION['username'] = $username;
            }
        }

        if ($_SESSION['user'] == true) {
            header("Location: /glass/public");            
        }else{
            self::doLogout();
        }

        // if (($param['username'] == "dipesh@gmail.com") && ($param['password'] == "1234")) {
        //     $_SESSION['user'] = true;
        //     header("Location: /glass/public");
        // } else {
        //     $_SESSION['user'] = false;
        //     self::doLogout();
        // }
    }

    public static function doLogout()
    {
        session_unset();
        session_destroy();
        header("Location: /glass/public");
    }

    public static function userdb($path)
    {
        $file = json_decode(file_get_contents($path));
        return $file;
    }
}
