<?php

namespace App\Model;

use PDO;
use PDOException;

class ProductModel
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    }
    public function addNewProduct($pname, $pdesc, $prate)
    {
        try {
            $this->connection->beginTransaction();
            $sql = "INSERT INTO `product`(`product_name`, `product_desc`, `product_rate`) 
            VALUES(:pname,:pdesc,:prate)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':pname', $pname);
            $stmt->bindParam(':pdesc', $pdesc);
            $stmt->bindParam(':prate', $prate);

            $stmt->execute();
            $this->connection->commit();

            $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "Product Added", 'data' => null);
        } catch (PDOException $e) {
            $this->connection->rollBack();
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while adding product', 'data' => null);
        }

        return $returnResult;
    }

    public function getProductList(int $startLimit, int $recordCount)
    {
        $startLimit = ($startLimit - 1) * $recordCount;
        try {
            $sqlPre = "SELECT * FROM `product`;";
            $stmtPre = $this->connection->prepare($sqlPre);
            $stmtPre->execute();
            $totalRecord = $stmtPre->rowCount();

            $sql = "SELECT * FROM `product` ORDER BY product_id ASC LIMIT :startlimit,:recordcount;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':startlimit', $startLimit, PDO::PARAM_INT);
            $stmt->bindParam(':recordcount', $recordCount, PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "List of Products", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No products found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching product details', 'data' => null);
        }

        return $returnResult;
    }

    public function getSearchKey($searchKey)
    {
        if (empty($searchKey)) {
            $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No products found", 'data' => null);
            return $returnResult;
        }
        $searchKey = '%' . $searchKey . '%';
        try {
            $sql = "SELECT * FROM `product` WHERE `product_name` LIKE :searchKey LIMIT 6;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam('searchKey', $searchKey);
            $stmt->execute();
            $totalRecord = $stmt->rowCount();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "List of Products", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No products found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching product details', 'data' => null);
        }

        return $returnResult;
    }
}
