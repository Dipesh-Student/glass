<?php

namespace App\Model;

use PDO;
use PDOException;

class ProcessModel
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    }

    public function addNewProcess(string $processName, float $processRate)
    {
        try {
            $this->connection->beginTransaction();
            $sql = "INSERT INTO `process`(`process_name`, `process_rate`)
            VALUES(:pname,:prate)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':pname', $processName, PDO::PARAM_STR);
            $stmt->bindParam(':prate', $processRate);

            $stmt->execute();
            $this->connection->commit();

            $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "New Process Added", 'data' => null);
        } catch (PDOException $e) {
            $this->connection->rollBack();
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while adding new Process', 'data' => null);
        }

        return $returnResult;
    }

    public function updateProcess($processId, $processName, $processRate)
    {
        try {
            $this->connection->beginTransaction();
            $sql = "UPDATE `process` 
            SET `process_name`=:pname,`process_rate`=:prate WHERE `process_id`=:processid";
            $stmt = $this->connection->prepare($sql);            
            $stmt->bindParam(':pname', $processName);
            $stmt->bindParam(':prate', $processRate);
            $stmt->bindParam(':processid', $processId);

            $stmt->execute();
            $this->connection->commit();

            $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "Process Updated", 'data' => null);
        } catch (PDOException $e) {
            $this->connection->rollBack();
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while updating process', 'data' => null);
        }

        return $returnResult;
    }

    public function getAllProcessess(int $startLimit, int $recordCount)
    {
        $startLimit = ($startLimit - 1) * $recordCount;
        try {
            $sqlPre = "SELECT * FROM `process`;";
            $stmtPre = $this->connection->prepare($sqlPre);
            $stmtPre->execute();
            $totalRecord = $stmtPre->rowCount();

            $sql = "SELECT * FROM `process` ORDER BY process_id ASC LIMIT :startlimit,:recordcount;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':startlimit', $startLimit, PDO::PARAM_INT);
            $stmt->bindParam(':recordcount', $recordCount, PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "List of Process", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No Process found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching process details', 'data' => null);
        }

        return $returnResult;
    }

    public function getProcessByKey($searchKey)
    {
        if (empty($searchKey)) {
            $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No process found", 'data' => null);
            return $returnResult;
        }
        $searchKey = '%' . $searchKey . '%';
        try {
            $sql = "SELECT * FROM `process` WHERE `process_name` LIKE :searchKey LIMIT 10;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':searchKey', $searchKey);
            $stmt->execute();
            $totalRecord = $stmt->rowCount();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "List of Process", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No process found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching prcess details', 'data' => null);
        }

        return $returnResult;
    }

    public function getProcessById($processId)
    {

        try {
            $sql = "SELECT * FROM `process` WHERE `process_id`=:processid;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':processid', $processId);
            $stmt->execute();
            $totalRecord = $stmt->rowCount();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "Process data", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No process found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching process details', 'data' => null);
        }

        return $returnResult;
    }
}
