<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require './vendor/autoload.php';
use Eshop\Controllers\Cart;

$cartObj = new Cart();
if ($_GET['action'] == 'add') {
    $result = $cartObj->addProductsToCart($_GET, $_POST);
}

if ($_GET['action'] == 'remove') {
    $result = $cartObj->removeProductsFromCart($_GET);
}
header('Location:cart.php');
