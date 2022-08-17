<?php

namespace Eshop;

class Cart
{
    public function __construct()
    {
    }

    public function manageCart($getdata, $postdata)
    {
        switch ($getdata['action']) {
            case 'add':
                if (isset($getdata['puuid'])) {
                    if (empty($postdata['quantity'])) {
                        $quantity = 1;
                    } else {
                        $quantity = $postdata['quantity'];
                    }
                    $puuid = $getdata['puuid'];
                    $products = new Products();
                    //get product by uuid..
                    $result = $products->getProductInfo($puuid);
                    $pdt_info = $result->fetch();

                    $itemArray = [$pdt_info['product_uuid'] => ['product_name' => $pdt_info['product_name'], 'code' => $pdt_info['product_code'], 'quantity' => $quantity, 'price' => $pdt_info['price'], 'photo' => $pdt_info['photo']]];

                    if (!empty($_SESSION['cart_item'])) {
                        if (in_array($pdt_info['product_uuid'], array_keys($_SESSION['cart_item']))) {
                            foreach ($_SESSION['cart_item'] as $k => $v) {
                                if ($pdt_info['product_uuid'] == $k) {
                                    if (empty($_SESSION['cart_item'][$k]['quantity'])) {
                                        $_SESSION['cart_item'][$k]['quantity'] = 0;
                                    }
                                    $_SESSION['cart_item'][$k]['quantity'] += $postdata['quantity'];
                                }
                            }
                        } else {
                            $_SESSION['cart_item'] = array_merge($_SESSION['cart_item'], $itemArray);
                        }
                    } else {
                        $_SESSION['cart_item'] = $itemArray;
                    }
                } else {
                    echo 'Not found';
                }
                break;
            case 'remove':
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
                break;
        }

        return true;
    }
}
