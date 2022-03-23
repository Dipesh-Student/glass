<?php 

namespace App\Controllers;

use App\View;

class ProcessController{
    public static function homeProcess($param = array()){
        return View::render('main-process',$param);
    }
}