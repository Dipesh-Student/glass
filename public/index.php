<?php

use App\Controllers\ProcessController;
use App\Controllers\ProductController;
use App\Controllers\QuoteController;
use App\Handlers\myblog;
use App\Handlers\SiteHome;
use App\Request;
use App\Router;
use App\View;
use Dotenv\Dotenv;

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

/**
 * Route home|empty|at path public > index.php
 * shows example with use of anonymous function as handler
 */
$Router->get("/", function () {
  return View::render('home', ['appName' => 'paap']);
});

$Router->get("/str", "hello-world");

$Router->get('/hello/{id}/{name}', [SiteHome::class, 'home']);
$Router->get('/profile/{id:\d+}/{username}', [SiteHome::class, 'home']);

$Router->get('/hello', [ProductController::class, 'hello']);

/**
 * Handle routes group from /product prefix
 */
$Router->groupPrefix('/product', function (Router $Router) {
  $Router->get('', [ProductController::class, 'homeProduct']);
  $Router->get('/{oprn}', [ProductController::class, 'homeProduct']);

  $Router->get('/form-add', function () {
    return View::render('/forms/form-product-add');
  });
  $Router->get('/form-update', function () {
    return View::render('/forms/form-product-update');
  });
  $Router->get('/form-delete', function () {
    return View::render('/forms/form-product-delete');
  });

  $Router->post('/add', [ProductController::class, 'addProduct', $_POST]);
  $Router->post('/getProduct', [ProductController::class, 'getProduct', $_POST]);
});

/**
 * Handle routes group from /process prefix
 */
$Router->groupPrefix('/process', function (Router $Router) {
  $Router->get('', [ProcessController::class, 'homeProcess']);
  $Router->get('/{oprn}', [ProductController::class, 'homeProduct']);

  $Router->get('/form-add', function () {
    return View::render('/forms/form-process-add');
  });
  $Router->get('/form-update', function () {
    return View::render('/forms/form-process-update');
  });
  $Router->get('/form-delete', function () {
    return View::render('/forms/form-process-delete');
  });
});

/**
 * Handle routes group from /quotation prefix
 */
$Router->groupPrefix('/quotes', function (Router $Router) {
  $Router->get('', [QuoteController::class, 'homeQuotes']);
  $Router->get('/{oprn}', [ProductController::class, 'homeProduct']);

  $Router->get('/form-add', function () {
    return View::render('/forms/form-quotes-add');
  });
  $Router->get('/form-update', function () {
    return View::render('/forms/form-quotes-update');
  });
  $Router->get('/form-delete', function () {
    return View::render('/forms/form-quotes-delete');
  });
});

/**
 * Route /contact-form
 * shows example with use of parameters in anonymous function as handler
 */
$Router->get("/contact-form", function () {
  return View::render('Temp-Form/contact-form', array('d' => 1, 'p' => 2));
});

$Router->get("/contact-forms", function () {
  return View::render('contact');
});

$Router->get('/myblog', ['myblog', 'execute', array('d' => 1)]);
$Router->get('/myblogs', ['myblog', 'nexecute', array()]);
$Router->get('/serve', [SiteHome::class, 'home']);

$Router->run();

// echo "<pre>";
// foreach ($Router->getRegisteredRoutes() as $val) {
//   echo $val['path'] . "\n";
// }
// echo "</pre>";

$env = Dotenv::createImmutable(realpath(__DIR__ . '../../'));
$env->load();

$db_user = $_ENV['DB_USER'];
