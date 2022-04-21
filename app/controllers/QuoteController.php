<?php

namespace App\Controllers;

use App\Model\QuoteModel;
use App\View;

class QuoteController
{
    public static function homeQuotes($param = array())
    {
        return View::render('main-quotes',$param);
    }

    public static function addNewQuotation($param = array())
    {
        $cc = new QuoteModel();
        $addNewChallan = $cc->addNewQuote($param['customer-id'], $param['customer-name']);

        if ($addNewChallan['error'] != true) {
            $msg = $addNewChallan['message'];
        } else {
            $msg = $addNewChallan['errorDescription'];
        }
        header("Location: /glass/public/quotes?message=$msg");
    }

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
        $cc = new QuoteModel();
        $getCustomerChallan = $cc->getCustomerChallan($param['customer-id']);

        if (($getCustomerChallan['error'] != true) && ($getCustomerChallan['data'] != null)) {
            echo json_encode($getCustomerChallan['data']);
        } else {
            echo json_encode($getCustomerChallan['errorDescription']);
        }
    }
}
