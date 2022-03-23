<?php

namespace App\Handlers;

use App\Model\Data\Data;
use App\View;

class myblog extends Data{
    public static function nexecute(){
        echo "from nexecute method";
        return View::render('Temp-Form/contact-Form');
    }
}