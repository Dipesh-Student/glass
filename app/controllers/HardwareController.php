<?php

namespace App\Controllers;

use App\Model\HardwareModel;
use App\View;

class HardwareController
{

    public static function homeHardware($param = array())
    {
        return View::render('main-hardware', $param);
    }

    /**
     * Add new Hardware
     *
     * @param array $param
     * @return void
     */
    public static function addHardware($param = array())
    {
        print_r($param);
        $hwName = $param['hardware-name'];
        $hwDesc = $param['hardware-Desc'];
        $hwRate = $param['hardware-rate'];
        $pm = new HardwareModel();
        $addHardware = $pm->addNewHardware($hwName, $hwDesc, $hwRate);

        if ($addHardware['error'] != true) {
            $msg = $addHardware['message'];
        } else {
            $msg = $addHardware['errorDescription'];
        }
        header("Location: /glass/public/hardware/form-add?message=$msg");
    }

    public static function updateHardware($param = array())
    {
        $pm = new HardwareModel();
        echo json_encode($pm->updateHardwareDetails(
            $param['hardware-id'],
            $param['hardware-name'],
            $param['hardware-Desc'],
            $param['hardware-rate']
        ));
    }

    public static function deleteProduct()
    {
        echo "deleteProduct";
    }

    public static function getHardware($param = array())
    {
        $hwId = $param['hw-id'];
        $pm = new HardwareModel();
        echo json_encode($pm->getHardwareById($hwId));
    }

    public static function getSearchResult($param = array())
    {
        $searchKey = $param['search-key'];
        $pm = new HardwareModel();
        echo json_encode($pm->getSearchKey($searchKey));
    }

    public static function getHardwareList($param = array())
    {
        $hm = new HardwareModel();
        $getHwList = $hm->getAllHardware($param['startLimit'], $param['recordCount']);

        if (($getHwList['error'] != true) && ($getHwList['data'] != null)) {
            echo json_encode($getHwList['data']);
        }
    }
}
