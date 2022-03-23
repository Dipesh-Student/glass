<?php

namespace App\Controllers;

use App\Model\Data\Data;
use App\View;

class ProductController
{
    public static function homeProduct($param = array())
    {
        return View::render('main-product', $param);
    }
    public static function addProduct($param = array())
    {
        print_r($param);
        return View::render('Temp-Product', $param);
    }
    public static function updateProduct()
    {
        echo "updateProduct";
    }
    public static function deleteProduct()
    {
        echo "deleteProduct";
    }

    public static function hello()
    {
        return View::render('hello');
    }

    public static function getProduct($param = array())
    {

        $array = array(
            "dipesh" => "dipesh",
            "age" => 25,
            "add" => "virar"
        );
        array_push($array, $param);
        echo json_encode($array);

        $data = new Data;
        $data->execute();
    }
}
