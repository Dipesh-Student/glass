<?php

namespace App\Model;

use PDO;
use PDOException;

class CustomerModel
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    }

    public function addNewCustomer(string $customerName, int $customerContact, string $customerEmail, string $customerAdd)
    {
        try {
            $this->connection->beginTransaction();
            $sql = "INSERT INTO `customer`(`c_name`, `c_contact`, `c_email`, `c_address`)
            VALUES(:cname,:ccontact,:cemail,:cadd)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':cname', $customerName, PDO::PARAM_STR);
            $stmt->bindParam(':ccontact', $customerContact, PDO::PARAM_INT);
            $stmt->bindParam(':cemail', $customerEmail, PDO::PARAM_STR);
            $stmt->bindParam(':cadd', $customerAdd, PDO::PARAM_STR);

            $stmt->execute();
            $this->connection->commit();

            $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "New Customer Added", 'data' => null);
        } catch (PDOException $e) {
            $this->connection->rollBack();
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while adding new Customer details', 'data' => null);
        }

        return $returnResult;
    }

    public function getAllCustomer(int $startLimit, int $recordCount)
    {
        if ($startLimit != 0) {
            $startLimit = ($startLimit - 1) * $recordCount;
        }
        
        try {
            $sqlPre = "SELECT * FROM `customer`;";
            $stmtPre = $this->connection->prepare($sqlPre);
            $stmtPre->execute();
            $totalRecord = $stmtPre->rowCount();

            $sql = "SELECT * FROM `customer` ORDER BY customer_id ASC LIMIT :startlimit,:recordcount;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':startlimit', $startLimit, PDO::PARAM_INT);
            $stmt->bindParam(':recordcount', $recordCount, PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "List of customer", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No customer found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching customer details', 'data' => null);
        }

        return $returnResult;
    }

    public function getCustomerById(int $customerId)
    {
        try {
            $sql = "SELECT * FROM `customer` WHERE customer_id=:customerid;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':customerid', $customerId, PDO::PARAM_INT);
            $stmt->execute();
            $totalRecord = $stmt->rowCount();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "Fetched Customer details", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No customer found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching customer details', 'data' => null);
        }

        return $returnResult;
    }

    public function getCustomerByKey(mixed $searchKey)
    {
        if (empty($searchKey)) {
            $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No customer found", 'data' => null);
            return $returnResult;
        }
        $searchKey = '%' . $searchKey . '%';
        try {
            $sql = "SELECT * FROM `customer` WHERE `c_name` LIKE :searchKey LIMIT 10;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':searchKey', $searchKey);
            $stmt->execute();
            $totalRecord = $stmt->rowCount();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "List of customer", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No customer found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching customer details', 'data' => null);
        }

        return $returnResult;
    }
}
