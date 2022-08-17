<?php

namespace Eshop;

class Products
{
    private $dbconnection;

    public function __construct()
    {
        $this->dbconnection = new Database();
    }

    public function listProducts()
    {
        return $this->dbconnection->queryDB('select id, product_code, product_uuid,product_name, description, price, photo, created_on, updated_on, is_active FROM products');
    }

    public function getProductInfo($puuid)
    {
        return $this->dbconnection->queryDB("select id, product_code, product_uuid,product_name, description, price, photo, created_on, updated_on, is_active FROM products WHERE product_uuid='".$puuid."'");
    }
}
