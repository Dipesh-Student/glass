<?php 

namespace App\Model\Data;

use App\View;

class Data{
    public function __construct()
    {
        echo "data";
    }

    public static function execute(){
        return View::render('Temp-Form/contact-form');
    }
}