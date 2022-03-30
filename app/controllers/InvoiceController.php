<?php

namespace App\Controllers;

use App\Model\ProductModel;
use App\View;

class InvoiceController{

    public static function homeInvoice()
    {
        return View::render('main-invoice');
    }

    public static function getProductById($param = array())
    {
        $productId = $param['product-id'];
        $pm = new ProductModel();
        echo json_encode($pm->getProductById($productId));
    }

}