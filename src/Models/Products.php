<?php

namespace Eshop\Models;

class Products extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllProducts()
    {
        return $this->queryDB('select id, product_code, product_uuid,product_name, description, price, photo, created_on, updated_on, is_active FROM products');
    }

    public function getProductByUUID($puuid)
    {
        return $this->queryDB("select id, product_code, product_uuid,product_name, description, price, photo, created_on, updated_on, is_active FROM products WHERE product_uuid='".$puuid."'");
    }
}
