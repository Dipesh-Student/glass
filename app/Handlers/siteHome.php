<?php 

namespace App\Handlers;

use App\View;

class SiteHome{
    
    public static function home($param = array()){
        print_r($param);
        return View::render('Temp-Form/contact-form',$param);
    }
}