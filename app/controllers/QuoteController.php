<?php

namespace App\Controllers;

use App\Model\InvoiceQuoteModel;
use App\Model\QuoteModel;
use App\View;

class QuoteController
{
    public static function homeQuotes($param = array())
    {
        return View::render('main-quotes',$param);
    }

    /**
     * Add new Quote for existing customer
     *
     * @param array $param
     * @return void
     */
    public static function addNewQuotation($param = array())
    {
        print_r($param);
        $cc = new QuoteModel();
        $addNewChallan = $cc->addNewQuote($param['customer-id'], $param['customer-name']);

        if ($addNewChallan['error'] != true) {
            $msg = $addNewChallan['message'];
        } else {
            $msg = $addNewChallan['errorDescription'];
        }
        header("Location: /glass/public/quotes?message=$msg");
    }

    /**
     * Creates new Invoice-Quotation record for quote
     *
     * @param array $param
     * @return void
     */
    public static function createQuotation($param = array())
    {
        $invoiceQuotationModel = new InvoiceQuoteModel();
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
            $invoiceQuotationModel->addNewInvoiceQuote(
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

        header("Location: /glass/public/quotes/gen-quotation");
    }

    /**
     * Get list of quotes
     *
     * @param array $param
     * @return void
     */
    public static function getQuoteList($param = array())
    {
        $cc = new QuoteModel();
        $getAllChallan = $cc->getAllQuotes($param['startLimit'], $param['recordCount']);

        if (($getAllChallan['error'] != true) && ($getAllChallan['data'] != null)) {
            echo json_encode($getAllChallan['data']);
        } else {
            echo json_encode($getAllChallan['errorDescription']);
        }
    }

    public static function getChallanByCustomer($param = array())
    {
        $cc = new InvoiceQuoteModel();
        $getCustomerChallan = $cc->getCustomerChallan($param['customer-id']);

        if (($getCustomerChallan['error'] != true) && ($getCustomerChallan['data'] != null)) {
            echo json_encode($getCustomerChallan['data']);
        } else {
            echo json_encode($getCustomerChallan['errorDescription']);
        }
    }

    public static function genQuotationBill($param = array())
    {
        $products = array();

        $cid = $param['challan-id'];

        $invm = new InvoiceQuoteModel();

        foreach ($cid as $val) {
            $data = $invm->getInvoiceByChallan($val);
            array_push($products, $data['data']['data']);
        }
        echo json_encode($products);
    }
}
