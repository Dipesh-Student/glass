<?php

namespace App\Model;

use PDO;
use PDOException;

class HardwareModel
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    }

    public function addNewHardware($hardwareName, $hardwareDesc, $hardwareRate)
    {
        try {
            $this->connection->beginTransaction();
            $sql = "INSERT INTO `hardware`(`hardware_name`, `hardware_desc`, `hardware_rate`) 
            VALUES(:hname,:hdesc,:hrate)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':hname', $hardwareName);
            $stmt->bindParam(':hdesc', $hardwareDesc);
            $stmt->bindParam(':hrate', $hardwareRate);

            $stmt->execute();
            $this->connection->commit();

            $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "Hardware Added", 'data' => null);
        } catch (PDOException $e) {
            $this->connection->rollBack();
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while adding Hardware', 'data' => null);
        }

        return $returnResult;
    }

    public function updateProductDetails($productId, $productName, $productDesc, $productRate)
    {
        try {
            $this->connection->beginTransaction();
            $sql = "UPDATE `product` 
            SET `product_name`=:pname,`product_desc`=:pdesc,`product_rate`=:prate
            WHERE `product_id`=:pid";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':pid', $productId);
            $stmt->bindParam(':pname', $productName);
            $stmt->bindParam(':pdesc', $productDesc);
            $stmt->bindParam(':prate', $productRate);

            $stmt->execute();
            $this->connection->commit();

            $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "Product Updated", 'data' => null);
        } catch (PDOException $e) {
            $this->connection->rollBack();
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while updating product', 'data' => null);
        }

        return $returnResult;
    }

    public function getAllHardware(int $startLimit, int $recordCount)
    {
        $startLimit = ($startLimit - 1) * $recordCount;
        try {
            $sqlPre = "SELECT * FROM `hardware`;";
            $stmtPre = $this->connection->prepare($sqlPre);
            $stmtPre->execute();
            $totalRecord = $stmtPre->rowCount();

            $sql = "SELECT * FROM `hardware` ORDER BY hardware_id ASC LIMIT :startlimit,:recordcount;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':startlimit', $startLimit, PDO::PARAM_INT);
            $stmt->bindParam(':recordcount', $recordCount, PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "List of Hardware", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No hardware found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching hardware details', 'data' => null);
        }

        return $returnResult;
    }
}
