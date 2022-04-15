<?php

namespace App\Controllers;

use App\Model\InvoiceModel;
use App\Model\ProductModel;
use App\View;

class InvoiceController
{

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

    public static function add($param = array())
    {
        echo "<pre>";
        print_r($param);
        $invoiceModel = new InvoiceModel();
        $count = 0;

        foreach ($param['product-id'] as $pid) {
            $custId = $param['customer-id'];
            $custName = $param['customer-name'];
            $challanId = $param['challan-id'];
            $productId = $pid;
            $pname = $param['pname'][$count];
            $productdimension = $param['product-length'][$count];
            $pquantity = $param['pquantity'][$count];
            $workdetails = $param['work-details'][$count];
            $producttotaldimension = $param['product-tdimension'][$count];
            $prate = $param['prate'][$count];
            $total = $param['total'][$count];
            $invoiceModel->addNewInvoice(
                $custId,
                $custName,
                $challanId,
                $productId,
                $pname,
                $productdimension,
                $pquantity,
                $workdetails,
                $producttotaldimension,
                $prate,
                $total
            );
            $count++;
        }
    }
}
