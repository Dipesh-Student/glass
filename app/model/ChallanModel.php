<?php

namespace App\Model;

use PDO;
use PDOException;

class ChallanModel
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    }

    public function addNewChallan($customerId, $customerName)
    {
        try {
            $this->connection->beginTransaction();
            $sql = "INSERT INTO `challan`(`customer_id`, `customer_name`) 
            VALUES (:custid,:custname);";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':custid', $customerId);
            $stmt->bindParam(':custname', $customerName);

            $stmt->execute();
            $this->connection->commit();

            $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "Challan Created", 'data' => null);
        } catch (PDOException $e) {
            $this->connection->rollBack();
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while creating challan', 'data' => null);
        }

        return $returnResult;
    }

    public function getChallanByCustomerName($customerName)
    {
        try {
            $sql = "SELECT * FROM `challan` WHERE customer_name=:cname;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':cname', $customerName);
            $stmt->execute();
            $totalRecord = $stmt->rowCount();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "Fetched challan details", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No challan found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching challan details', 'data' => null);
        }

        return $returnResult;
    }

    public function getChallanByChallanId($challanId)
    {
        try {
            $sql = "SELECT * FROM `challan` WHERE challan_id=:cid;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':cid', $challanId);
            $stmt->execute();
            $totalRecord = $stmt->rowCount();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "Fetched challan details", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No challan found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching challan details', 'data' => null);
        }

        return $returnResult;
    }

    public function getAllChallan(int $startLimit, int $recordCount)
    {
        if ($startLimit != 0) {
            $startLimit = ($startLimit - 1) * $recordCount;
        }

        try {
            $sqlPre = "SELECT * FROM `challan`;";
            $stmtPre = $this->connection->prepare($sqlPre);
            $stmtPre->execute();
            $totalRecord = $stmtPre->rowCount();

            $sql = "SELECT * FROM `challan` ORDER BY challan_id ASC LIMIT :startlimit,:recordcount;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':startlimit', $startLimit, PDO::PARAM_INT);
            $stmt->bindParam(':recordcount', $recordCount, PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "List of challan", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No challan found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching challan details', 'data' => null);
        }

        return $returnResult;
    }

    public function getCustomerChallan($customerId)
    {
        try {
            $sql = "SELECT * FROM `challan` WHERE customer_id=:cid;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':cid', $customerId);
            $stmt->execute();
            $totalRecord = $stmt->rowCount();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "Fetched customer challan details", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No challan found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching challan details', 'data' => null);
        }

        return $returnResult;
    }
}
