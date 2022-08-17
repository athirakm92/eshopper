<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require './vendor/autoload.php';
use Eshop\Addcart;
use Eshop\Removecart;

$addcartobj = new Addcart();
if ($_GET['action'] == 'add') {
    $result = $addcartobj->addProductsToCart($_GET, $_POST);
}

$removecartobj = new Removecart();
if ($_GET['action'] == 'remove') {
    $result = $removecartobj->removeProductsFromCart($_GET, $_POST);
}
header('Location:cart.php');
