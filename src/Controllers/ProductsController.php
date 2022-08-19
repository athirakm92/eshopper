<?php

namespace Eshop\Controllers;

use Eshop\Models\Products;

class ProductsController
{
    private $products;

    public function __construct()
    {
        $this->products = new Products();
    }

    public function fetchAllProducts()
    {
        return $this->products->getAllProducts();
    }

    public function fetchSingleProduct($productUUID)
    {
        $resultSingleProduct = $this->products->getProductByUUID($productUUID);

        return $resultSingleProduct->fetch();
    }
}
