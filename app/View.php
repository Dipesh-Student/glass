<?php

namespace App;

use Exception;

class View
{
    public static function render($templateName, $param = array())
    {
        //echo $templateName;
        //print_r($param);
        extract($param, EXTR_PREFIX_ALL, "html"); //this function will convert array key's into variable and assign values accordingly
        ob_start();

        $filePath = "../views/templates/{$templateName}.php";
        if (file_exists($filePath) && is_readable($filePath)) {
            return include_once($filePath);
        } else {
            throw new Exception("$templateName Not Found");
        }
        return ob_get_clean();
    }
}
