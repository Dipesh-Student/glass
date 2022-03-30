<?php

namespace App\Controllers;

use App\Model\ProcessModel;
use App\View;

class ProcessController
{
    public static function homeProcess($param = array())
    {
        return View::render('main-process', $param);
    }

    public static function addProcess($param = array())
    {
        $process = new ProcessModel();
        $addProcess = $process->addNewProcess($param['process-name'],$param['process-rate']);

        if ($addProcess['error'] != true) {
            echo $addProcess['message'];
        } else {
            echo $addProcess['errorDescription'];
        }
        header("Location: /glass/public/process/form-add");
    }

    public static function getProcessList($param = array()){
        $process = new ProcessModel();
        $getAllProcess = $process->getAllProcessess($param['startLimit'], $param['recordCount']);
        if (($getAllProcess['error'] != true) && ($getAllProcess['data'] != null)) {
            echo json_encode($getAllProcess['data']);
        }
    }
}
