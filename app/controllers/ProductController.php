<?php

namespace App\Controllers;

use App\Model\ProductModel;
use App\View;

class ProductController
{

    public function __construct()
    {
    }

    public static function homeProduct($param = array())
    {
        return View::render('main-product', $param);
    }

    /**
     * Add new Product
     *
     * @param array $param
     * @return void
     */
    public static function addProduct($param = array())
    {
        $productName = $param['product-name'];
        $productDesc = $param['product-Desc'];
        $productRate = $param['product-rate'];
        $pm = new ProductModel;
        $addProduct = $pm->addNewProduct($productName, $productDesc, $productRate);

        if ($addProduct['error'] != true) {
            echo $addProduct['message'];
        } else {
            echo $addProduct['errorDescription'];
        }
        header("Location: /product/form-add");
    }
    public static function updateProduct($param = array())
    {
        $pm = new ProductModel();
        echo json_encode($pm->updateProductDetails(
            $param['product-id'],
            $param['product-name'],
            $param['product-Desc'],
            $param['product-rate']
        ));
    }
    public static function deleteProduct()
    {
        echo "deleteProduct";
    }

    public static function getProductById($param = array())
    {
        $productId = $param['product-id'];
        $pm = new ProductModel();
        echo json_encode($pm->getProductById($productId));
    }

    public static function getSearchResult($param = array())
    {
        $searchKey = $param['search-key'];
        $pm = new ProductModel();
        echo json_encode($pm->getSearchKey($searchKey));
    }

    public static function fetchAllProducts($param = array())
    {
        $pm = new ProductModel();
        $productList = $pm->getProductList($param['startLimit'], $param['recordCount']);

        if (($productList['error'] != true) && ($productList['data'] != null)) {
            echo json_encode($productList['data']);
        }
    }
}
