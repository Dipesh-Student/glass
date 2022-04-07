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

    public function updateHardwareDetails($hwId, $hwName, $hwDesc, $hwRate)
    {
        try {
            $this->connection->beginTransaction();
            $sql = "UPDATE `hardware` 
            SET `hardware_name`=:hname,`hardware_desc`=:hdesc,`hardware_rate`=:hrate
            WHERE `hardware_id`=:hid";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':hid', $hwId);
            $stmt->bindParam(':hname', $hwName);
            $stmt->bindParam(':hdesc', $hwDesc);
            $stmt->bindParam(':hrate', $hwRate);

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

    public function getSearchKey($searchKey)
    {
        if (empty($searchKey)) {
            $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No products found", 'data' => null);
            return $returnResult;
        }
        $searchKey = '%' . $searchKey . '%';
        try {
            $sql = "SELECT * FROM `hardware` WHERE `hardware_name` LIKE :searchKey LIMIT 10;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':searchKey', $searchKey);
            $stmt->execute();
            $totalRecord = $stmt->rowCount();

            if ($stmt->rowCount() != 0) {
                $returnResult = array(
                    'error' => false, 'errorDescription' => null, 'message' => "List of Hardware", 'data' => array(
                        "totalRecords" => $totalRecord,
                        "data" => $stmt->fetchAll()
                    )
                );
            } else {
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No Hardware found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching product details', 'data' => null);
        }

        return $returnResult;
    }

    public function getHardwareById($hwId)
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
                $returnResult = array('error' => false, 'errorDescription' => null, 'message' => "No phardware found", 'data' => null);
            }
        } catch (PDOException $e) {
            $returnResult = array('error' => true, 'errorDescription' => $e->getMessage(), 'message' => 'Error occured while fetching hardware details', 'data' => null);
        }

        return $returnResult;
    }
}
