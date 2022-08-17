<?php

namespace Eshop;

class Addcart
{
    private $products;

    public function __construct()
    {
        $this->products = new Products();
    }

    public function addProductsToCart($getdata, $postdata)
    {
        if (isset($getdata['puuid'])) {
            if (empty($postdata['quantity'])) {
                $quantity = 1;
            } else {
                $quantity = $postdata['quantity'];
            }
            $puuid = $getdata['puuid'];
            //get product by uuid..
            $result = $this->products->getProductInfo($puuid);
            $pdt_info = $result->fetch();

            $this->addCartToSession($pdt_info, $postdata['quantity']);
        } else {
            return 'Not found';
        }

        return true;
    }

    public function addCartToSession($pdt_info, $quantity)
    {
        $itemArray = [$pdt_info['product_uuid'] => ['product_name' => $pdt_info['product_name'], 'code' => $pdt_info['product_code'], 'quantity' => $quantity, 'price' => $pdt_info['price'], 'photo' => $pdt_info['photo']]];
        if (!empty($_SESSION['cart_item'])) {
            if (in_array($pdt_info['product_uuid'], array_keys($_SESSION['cart_item']))) {
                foreach ($_SESSION['cart_item'] as $k => $v) {
                    if ($pdt_info['product_uuid'] == $k) {
                        if (empty($_SESSION['cart_item'][$k]['quantity'])) {
                            $_SESSION['cart_item'][$k]['quantity'] = 0;
                        }
                        $_SESSION['cart_item'][$k]['quantity'] += $quantity;
                    }
                }
            } else {
                $_SESSION['cart_item'] = array_merge($_SESSION['cart_item'], $itemArray);
            }
        } else {
            $_SESSION['cart_item'] = $itemArray;
        }
    }
}
