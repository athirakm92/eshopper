<?php

namespace Eshop;

class ListProducts
{
    private $dbconnection;

    public function __construct()
    {
        $this->dbconnection = new Database();
    }

    public function getAllProducts()
    {
        return $this->dbconnection->queryDB('select id, product_code, product_uuid,product_name, description, price, photo, created_on, updated_on, is_active FROM products');
    }
}
