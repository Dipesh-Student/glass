<?php 

namespace App\Handlers;

use App\View;

class SiteHome{
    
    public static function home($param = array()){
        return View::render('Temp-Form/contact-form',$param);
    }
}