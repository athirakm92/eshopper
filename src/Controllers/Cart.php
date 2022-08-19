<?php

namespace Eshop\Controllers;

use Eshop\Models\Products;

class Cart
{
    private $products;

    public function __construct()
    {
        $this->products = new Products();
    }

    public function addProductsToCart($getData, $postData)
    {
        if (!isset($getData['puuid'])) {
            return 'Not found';
        }
        $quantity = 1;
        if (!empty($postData['quantity'])) {
            $quantity = $postData['quantity'];
        }

        //get product by uuid..
        $singleProductQuery = $this->products->getProductByUUID($getData['puuid']);
        $productInfo = $singleProductQuery->fetch();

        $this->addProductsToSession($productInfo, $quantity);

        return true;
    }

    public function addProductsToSession($productInfo, $quantity)
    {
        $productUUID = $productInfo['product_uuid'];
        $itemArray = [$productUUID => ['product_name' => $productInfo['product_name'], 'code' => $productInfo['product_code'], 'quantity' => $quantity, 'price' => $productInfo['price'], 'photo' => $productInfo['photo']]];
        if (empty($_SESSION['cart_item'])) {
            $_SESSION['cart_item'] = $itemArray;

            return true;
        }
        if (!$this->checkProductsExistsInCart($productUUID)) {
            $_SESSION['cart_item'] = array_merge($_SESSION['cart_item'], $itemArray);

            return true;
        }
        if (empty($_SESSION['cart_item'][$productUUID]['quantity'])) {
            $_SESSION['cart_item'][$productUUID]['quantity'] = 0;
        }
        $_SESSION['cart_item'][$productUUID]['quantity'] += $quantity;

        return true;
    }

    public function checkProductsExistsInCart($productUUID)
    {
        if (in_array($productUUID, array_keys($_SESSION['cart_item']))) {
            return true;
        }

        return false;
    }

    public function removeProductsFromCart($getData)
    {
        if (empty($_SESSION['cart_item'])) {
            return true;
        }
        foreach ($_SESSION['cart_item'] as $k => $v) {
            if ($getData['puuid'] == $k) {
                unset($_SESSION['cart_item'][$k]);
            }
            if (empty($_SESSION['cart_item'])) {
                unset($_SESSION['cart_item']);
            }
        }

        return true;
    }
}
