<?php

namespace App\Controllers;

use App\View;

class QuoteController{
    public static function homeQuotes(){
        return View::render('main-quotes');
    }
}