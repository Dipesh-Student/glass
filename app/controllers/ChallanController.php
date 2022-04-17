<?php

namespace App\Controllers;

use App\Model\ChallanModel;
use App\View;

class ChallanController
{
    public static function homeChallan($param = array())
    {
        return View::render('main-challan');
    }

    public static function addNewChallan($param = array())
    {
        $cc = new ChallanModel();
        $addNewChallan = $cc->addNewChallan($param['customer-id'], $param['customer-name']);

        if ($addNewChallan['error'] != true) {
            $msg = $addNewChallan['message'];
        } else {
            $msg = $addNewChallan['errorDescription'];
        }
        header("Location: /glass/public/invoice?message=$msg");
    }

    public static function getChallanList($param = array())
    {
        $cc = new ChallanModel();
        $getAllChallan = $cc->getAllChallan($param['startLimit'], $param['recordCount']);

        if (($getAllChallan['error'] != true) && ($getAllChallan['data'] != null)) {
            echo json_encode($getAllChallan['data']);
        } else {
            echo json_encode($getAllChallan['errorDescription']);
        }
    }

    public static function getChallanByCustomer($param = array())
    {
        $cc = new ChallanModel();
        $getCustomerChallan = $cc->getCustomerChallan($param['customer-id']);

        if (($getCustomerChallan['error'] != true) && ($getCustomerChallan['data'] != null)) {
            echo json_encode($getCustomerChallan['data']);
        } else {
            echo json_encode($getCustomerChallan['errorDescription']);
        }
    }
}
