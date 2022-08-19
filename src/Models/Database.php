<?php

namespace Eshop\Models;

use PDO;
use PDOException;

class Database
{
    private $conn;
    private $dbHost;
    private $dbUser;
    private $dbPassword;
    private $dbname;

    public function __construct()
    {
        $configdata = new Config();
        $this->dbHost = $configdata->dbHost;
        $this->dbUser = $configdata->dbUser;
        $this->dbPassword = $configdata->dbPassword;
        $this->dbname = $configdata->dbname;
        $this->getConnected();
    }

    public function getConnected()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->dbHost;dbname=$this->dbname", $this->dbUser, $this->dbPassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
        }
    }

    public function queryDB($queryString)
    {
        return $this->conn->query($queryString);
    }

    public function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }
}
