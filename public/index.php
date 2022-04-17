<?php

session_start();

use App\Controllers\AuthController;
use App\Controllers\ChallanController;
use App\Controllers\CustomerController;
use App\Controllers\HardwareController;
use App\Controllers\InvoiceController;
use App\Controllers\ProcessController;
use App\Controllers\ProductController;
use App\Controllers\QuoteController;
use App\Model\ProductModel;
use App\Request;
use App\Router;
use App\View;

require_once("../vendor/autoload.php");
include("../const.php");

$Router = new Router(new Request);

/**
 * route to handle HTTP/1.0 404 Not found
 * @return resource return a 404 html template using View->render 
 */
$Router->addNotFoundHandler(function () {
  return View::render('Temp-Error/404');
});

if (isset($_SESSION['user']) === false) {
  //todo if not user not logged

  $Router->get(BASE_DIR . '/login', function () {
    return View::render('forms/form-login');
  });

  $Router->post(BASE_DIR . '/login', [AuthController::class, 'doLogin', $_POST]);

  $Router->run();
} else {
  //todo user is logged in

  /**
   * Route home|empty|at path public > index.php
   * shows example with use of anonymous function as handler
   */
  $Router->get(BASE_DIR, function () {
    return View::render('home', ['appName' => 'paap']);
  });

  $Router->post(BASE_DIR . '/logout', [AuthController::class, 'doLogout']);

  /**
   * Handle routes group from /product prefix
   */
  $Router->groupPrefix(BASE_DIR . '/product', function (Router $Router) {
    $Router->get('', [ProductController::class, 'homeProduct', array("pageTitle" => 'Globe | Home')]);
    $Router->get('/{oprn}', [ProductController::class, 'homeProduct']);

    $Router->get('/form-add', function () {
      return View::render('/forms/form-product-add', array("pageTitle" => 'Globe | Add Product'));
    });

    $Router->get('/form-update', function () {
      $pm = new ProductModel();
      $param = $pm->getProductList(1, 10);
      return View::render('/forms/form-product-update', $param);
    });
    $Router->get('/form-delete', function () {
      return View::render('/forms/form-product-delete');
    });

    $Router->post('/add', [ProductController::class, 'addProduct', $_POST]);
    //sim-ajax-request
    $Router->post('/update', [ProductController::class, 'updateProduct', $_POST]);
    $Router->post('/getProduct', [ProductController::class, 'getProductById', $_POST]);
    $Router->post('/getProductList', [ProductController::class, 'fetchAllProducts', $_POST]);
    $Router->post('/getSearchResult', [ProductController::class, 'getSearchResult', $_POST]);
  });

  /**
   * Handle routes group from /process prefix
   */
  $Router->groupPrefix(BASE_DIR . '/process', function (Router $Router) {
    $Router->get('', [ProcessController::class, 'homeProcess', array("pageTitle" => 'Globe | Process')]);

    $Router->post('/getProcessList', [ProcessController::class, 'getProcessList', $_POST]);

    $Router->get('/form-add', function () {
      return View::render('/forms/form-process-add', array("pageTitle" => 'Globe | Add process'));
    });
    $Router->post('/form-add', [ProcessController::class, 'addProcess', $_POST]);

    $Router->get('/form-update', function () {
      return View::render('/forms/form-process-update', array("pageTitle" => 'Globe | Update process'));
    });
    $Router->post('/form-update', [ProcessController::class, 'updateProcess', $_POST]);

    $Router->get('/form-delete', function () {
      return View::render('/forms/form-process-delete');
    });

    $Router->post('/getSearchResult', [ProcessController::class, 'getSearchByKey', $_POST]);
    $Router->post('/getProcess', [ProcessController::class, 'getProcessById', $_POST]);
  });

  /**
   * Handle routes group from /hardware prefix
   */
  $Router->groupPrefix(BASE_DIR . '/hardware', function (Router $Router) {
    $Router->get('', [HardwareController::class, 'homeHardware', array("pageTitle" => 'Globe | Hardware')]);

    $Router->post('/getHardwareList', [HardwareController::class, 'getHardwareList', $_POST]);

    $Router->get('/form-add', function () {
      return View::render('/forms/form-hardware-add', array("pageTitle" => 'Globe | Add hardware'));
    });
    $Router->post('/form-add', [HardwareController::class, 'addHardware', $_POST]);

    $Router->get('/form-update', function () {
      return View::render('/forms/form-hardware-update', array("pageTitle" => 'Globe | Update hardware'));
    });
    $Router->post('/form-update', [HardwareController::class, 'updateHardware', $_POST]);

    $Router->get('/form-delete', function () {
      return View::render('/forms/form-process-delete');
    });

    $Router->post('/getSearchResult', [HardwareController::class, 'getSearchResult', $_POST]);
    $Router->post('/getHardware', [HardwareController::class, 'getHardware', $_POST]);
  });

  /**
   * Handle routes group from /customer prefix
   */
  $Router->groupPrefix(BASE_DIR . '/customer', function (Router $Router) {
    $Router->get('', [CustomerController::class, 'homeCustomer']);

    $Router->post('/getCustomerList', [CustomerController::class, 'getCustomerList', $_POST]);

    $Router->get('/form-add', function () {
      return View::render('/forms/form-customer-add');
    });
    $Router->post('/form-add', [CustomerController::class, 'addCustomer', $_POST]);

    $Router->get('/form-update', function () {
      return View::render('/forms/form-customer-update');
    });

    $Router->get('/form-delete', function () {
      return View::render('/forms/form-process-delete');
    });

    $Router->post('/form-update', [CustomerController::class, 'updateCustomer', $_POST]);
    $Router->post('/getCustomer', [CustomerController::class, 'getCustomer', $_POST]);
    $Router->post('/getSearchResult', [CustomerController::class, 'getCustomerByKey', $_POST]);
  });

  /**
   * Handle routes group from /quotation prefix
   */
  $Router->groupPrefix('/quotes', function (Router $Router) {
    $Router->get('', [QuoteController::class, 'homeQuotes']);
    $Router->get('/{oprn}', [ProductController::class, 'homeProduct']);

    $Router->get('/form-add', function () {
      return View::render('/forms/form-quote-add');
    });
    $Router->get('/form-update', function () {
      return View::render('/forms/form-quote-update');
    });
    $Router->get('/form-delete', function () {
      return View::render('/forms/form-quote-delete');
    });
  });

  /**
   * Handle routes group from /challan prefix
   */
  $Router->groupPrefix(BASE_DIR . '/challan', function (Router $Router) {
    $Router->get('', [ChallanController::class, 'homeChallan', array("pageTitle" => 'Globe | Hardware')]);

    $Router->get('/form-add', function () {
      return View::render('/forms/form-challan-add');
    });
    $Router->get('/form-update', function () {
      return View::render('/forms/form-challan-update');
    });
    $Router->get('/form-delete', function () {
      return View::render('/forms/form-challan-delete');
    });

    $Router->post('/retrieveUserChallan', [ChallanController::class, 'getChallanByCustomer', $_POST]);
    $Router->post('/form-challan-add', [ChallanController::class, 'addNewChallan', $_POST]);
    $Router->post('/getChallanList', [ChallanController::class, 'getChallanList', $_POST]);
  });

  $Router->groupPrefix(BASE_DIR . '/invoice', function (Router $Router) {
    $Router->get('', [InvoiceController::class, 'homeInvoice']);
    $Router->get('/gen-bill', function () {
      return View::render('/forms/form-bill');
    });

    $Router->post('/gen-bill', [InvoiceController::class, 'genBill', $_POST]);
    $Router->post('/getCustInvByChllaan', [InvoiceController::class, 'getCustInvByChllaan', $_POST]);
    $Router->post('/add', [InvoiceController::class, 'add', $_POST]);
  });

  $Router->run();
}


// echo "<pre>";
// foreach ($Router->getRegisteredRoutes() as $val) {
//   echo $val['path'] . "\n";
// }
// echo "</pre>";
