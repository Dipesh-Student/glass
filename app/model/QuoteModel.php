<?php

namespace App\Model;

use PDO;
use PDOException;

class QuoteModel
{

    protected $connection;

    public function __construct()
    {
        $this->connection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    }

    public function addNewQuote($customerId, $customerName)
    {
        try {
            $this->connection->beginTransaction();
            $sql = "INSERT INTO `quotes`(`customer_id`, `customer_name`) 
            VALUES (:custid,:custname);";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':custid', $customerId);
            $stmt->bindParam(':custname', $customerName);

            $stmt->execute();
            $this->connection->commit();

            $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "New Quotation Created", 'data' => null);
        } catch (PDOException $e) {
            $this->connection->rollBack();
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while creating Quotation', 'data' => null);
        }

        return $returnResult;
    }

    public function updateInvoice()
    {
    }

    public function getAllQuotes(int $startLimit, int $recordCount)
    {
        if ($startLimit != 0) {
            $startLimit = ($startLimit - 1) * $recordCount;
        }

        try {
            $sqlPre = "SELECT * FROM `quotes`;";
            $stmtPre = $this->connection->prepare($sqlPre);
            $stmtPre->execute();
            $totalRecord = $stmtPre->rowCount();

            $sql = "SELECT * FROM `quotes` ORDER BY quote_id ASC LIMIT :startlimit,:recordcount;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':startlimit', $startLimit, PDO::PARAM_INT);
            $stmt->bindParam(':recordcount', $recordCount, PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "List of Quotes", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No Quote data found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching Quotation details', 'data' => null);
        }

        return $returnResult;
    }

    public function getInvoiceByCustomer($customerId)
    {
        try {
            $sql = "SELECT * FROM `hardware` WHERE hardware_id=:hardwareid;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':hardwareid', $hwId, PDO::PARAM_INT);
            $stmt->execute();
            $totalRecord = $stmt->rowCount();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "Fetched hardware details", 'data' => array(
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

    public function getInvoiceById()
    {
    }

    public function getInvoiceByChallan($challanId)
    {
        try {
            $sql = "SELECT * FROM `invoice` WHERE `iv_challan_id`=:challanid;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':challanid', $challanId);
            $stmt->execute();
            $totalRecord = $stmt->rowCount();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "Fetched all challan details", 'data' => array(
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

    public function getInvoiceByKey()
    {
    }
}
