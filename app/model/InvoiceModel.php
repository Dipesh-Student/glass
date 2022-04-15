<?php

namespace App\Model;

use PDO;
use PDOException;

class InvoiceModel
{

    protected $connection;

    public function __construct()
    {
        $this->connection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    }

    public function addNewInvoice($custid, $custname, $challanid, $inpdid, $ivpdname, $ivpddim, $ivpdquantity, $ivpdwork, $ivpdtdim, $ivpdrate, $ivtotal)
    {
        try {

            $this->connection->beginTransaction();

            $sql = "INSERT INTO `invoice`(`customer_id`, `customer_name`,`iv_challan_id`,`iv_product_id`, `iv_product_name`, `iv_product_dim`, `iv_product_quantity`, `iv_product_work`, `iv_product_tdim`, `iv_product_rate`, `iv_total`) 
            VALUES (:custid,:custname,:ivchallanid,:inpdid,:ivpdname,:ivpddim,:ivpdquantity,:ivpdwork,:ivpdtdim,:ivpdrate,:ivtotal);";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':custid', $custid);
            $stmt->bindParam(':custname', $custname);
            $stmt->bindParam(':ivchallanid', $challanid);
            $stmt->bindParam(':inpdid', $inpdid);
            $stmt->bindParam(':ivpdname', $ivpdname);
            $stmt->bindParam(':ivpddim', $ivpddim);
            $stmt->bindParam(':ivpdquantity', $ivpdquantity);
            $stmt->bindParam('ivpdwork', $ivpdwork);
            $stmt->bindParam(':ivpdtdim', $ivpdtdim);
            $stmt->bindParam(':ivpdrate', $ivpdrate);
            $stmt->bindParam(':ivtotal', $ivtotal);
            $stmt->execute();

            $this->connection->commit();
            $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "New invoice Added", 'data' => null);
        } catch (PDOException $e) {
            $this->connection->rollBack();
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while adding new invoice', 'data' => null);
        }

        return $returnResult;
    }

    public function updateInvoice()
    {
    }

    public function getAllInvoice()
    {
    }

    public function getInvoiceById()
    {
    }

    public function getInvoiceByChallan()
    {
    }

    public function getInvoiceByKey()
    {
    }
}
