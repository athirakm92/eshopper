<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require './vendor/autoload.php';
use Eshop\Database;

switch ($_GET['action']) {
    case 'add':
        if (isset($_GET['puuid'])) {
            if (empty($_POST['quantity'])) {
                $quantity = 1;
            } else {
                $quantity = $_POST['quantity'];
            }
            $puuid = $_GET['puuid'];
            $dbconnection = new Database();

            //get product by uuid..

            $pdt_info = $dbconnection->getProductDetails($puuid);

            $itemArray = [$pdt_info['product_uuid'] => ['product_name' => $pdt_info['product_name'], 'code' => $pdt_info['product_code'], 'quantity' => $quantity, 'price' => $pdt_info['price'], 'photo' => $pdt_info['photo']]];

            if (!empty($_SESSION['cart_item'])) {
                if (in_array($pdt_info['product_uuid'], array_keys($_SESSION['cart_item']))) {
                    foreach ($_SESSION['cart_item'] as $k => $v) {
                        if ($pdt_info['product_uuid'] == $k) {
                            if (empty($_SESSION['cart_item'][$k]['quantity'])) {
                                $_SESSION['cart_item'][$k]['quantity'] = 0;
                            }
                            $_SESSION['cart_item'][$k]['quantity'] += $_POST['quantity'];
                        }
                    }
                } else {
                    $_SESSION['cart_item'] = array_merge($_SESSION['cart_item'], $itemArray);
                }
            } else {
                $_SESSION['cart_item'] = $itemArray;
            }
            header('Location:cart.php');
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
        header('Location:cart.php');
        break;
}
