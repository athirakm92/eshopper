<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require './vendor/autoload.php';
use Eshop\AddCart;
use Eshop\RemoveCart;

$addcartobj = new AddCart();
if ($_GET['action'] == 'add') {
    $result = $addcartobj->addProductsToCart($_GET, $_POST);
}

$removecartobj = new RemoveCart();
if ($_GET['action'] == 'remove') {
    $result = $removecartobj->removeProductsFromCart($_GET, $_POST);
}
header('Location:cart.php');
