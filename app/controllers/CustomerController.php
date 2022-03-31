<?php

namespace App\Controllers;

use App\Model\CustomerModel;
use App\View;

class CustomerController
{

    public static function homeCustomer($param = array())
    {
        return View::render('main-customer', $param);
    }

    public static function addCustomer($param = array())
    {
        $CustomerModel = new CustomerModel();
        $addCustomer = $CustomerModel->addNewCustomer($param['cname'], $param['ccontact'], $param['cemail'], $param['cadd']);
        if ($addCustomer['error'] != true) {
            echo $addCustomer['message'];
        } else {
            echo $addCustomer['errorDescription'];
        }
    }

    public static function updateCustomer($param = array())
    {
        $CustomerModel = new CustomerModel();
        $addCustomer = $CustomerModel->updateCustomerDetails($param['cid'], $param['cname'], $param['ccontact'], $param['cemail'], $param['cadd']);
        if ($addCustomer['error'] != true) {
            echo $addCustomer['message'];
        } else {
            echo $addCustomer['errorDescription'];
        }
    }

    public static function deleteCustomer()
    {
    }

    public static function getCustomerList($param = array())
    {
        $cc = new CustomerModel();
        $getAllCustomer = $cc->getAllCustomer($param['startLimit'], $param['recordCount']);

        if (($getAllCustomer['error'] != true) && ($getAllCustomer['data'] != null)) {
            echo json_encode($getAllCustomer['data']);
        } else {
            echo json_encode($getAllCustomer['errorDescription']);
        }
    }

    public static function getCustomer($param = array())
    {
        $cc = new CustomerModel();
        $getCustomer = $cc->getCustomerById($param['customer-id']);

        if (($getCustomer['error'] != true) && ($getCustomer['data'] != null)) {
            echo json_encode($getCustomer['data']);
        } else {
            echo json_encode($getCustomer['message']);
        }
    }

    public static function getCustomerByKey($param = array())
    {
        $cm = new CustomerModel();
        $getCustomer = $cm->getCustomerByKey($param['search-key']);

        if (($getCustomer['error'] != true) && ($getCustomer['data'] != null)) {
            echo json_encode($getCustomer['data']);
        } else {
            echo json_encode($getCustomer['message']);
        }
    }
}
