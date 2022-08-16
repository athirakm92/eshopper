<?php

namespace Eshop;

use mysqli;

class Database
{
    protected $dbConn; //connection link

    protected static $dbHost = 'localhost';
    protected static $dbUser = 'root';
    protected static $dbPassword = '@Athira321#';
    protected static $db = 'eshop';

    public function __construct()
    {
        $this->getConnected();
    }

    public function getConnected()
    {
        //if connection link allready exists return it;
        if (isset($this->dbConn)) {
            return $this->dbConn;
        }

        $this->dbConn = new mysqli(self::$dbHost, self::$dbUser, self::$dbPassword, self::$db);

        return $this->dbConn;
    }

    public function queryDB($queryString)
    {
        return mysqli_query($this->getConnected(), $queryString);
    }

    public function close()
    {
        mysqli_close($this->dbConn);
    }

    public function listProducts()
    {
        return $this->queryDB('select id, product_code, product_uuid,product_name, description, price, photo, created_on, updated_on, is_active FROM products');
    }

    public function getProductInfo($puuid)
    {
        $result = $this->queryDB("select id, product_code, product_uuid,product_name, description, price, photo, created_on, updated_on, is_active FROM products WHERE product_uuid='".$puuid."'");

        return mysqli_fetch_object($result);
    }

    public function getProductDetails($puuid)
    {
        $result = $this->queryDB("select id, product_code, product_uuid,product_name, description, price, photo, created_on, updated_on, is_active FROM products WHERE product_uuid='".$puuid."'");

        return $result->fetch_array(MYSQLI_ASSOC);
    }
}
