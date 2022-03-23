<?php

namespace App\Controllers;

use App\View;

class ChallanController{
    public static function homeChallan(){
        return View::render('main-challan');
    }
}