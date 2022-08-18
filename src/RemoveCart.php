<?php

namespace Eshop;

class RemoveCart
{
    private $products;

    public function __construct()
    {
    }

    public function removeProductsFromCart($getdata, $postdata)
    {
        if (!empty($_SESSION['cart_item'])) {
            foreach ($_SESSION['cart_item'] as $k => $v) {
                if ($_GET['puuid'] == $k) {
                    unset($_SESSION['cart_item'][$k]);
                }
                if (empty($_SESSION['cart_item'])) {
                    unset($_SESSION['cart_item']);
                }
            }
        }

        return true;
    }
}
