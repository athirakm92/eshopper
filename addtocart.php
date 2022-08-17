<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require './vendor/autoload.php';
use Eshop\Cart;

$cartclass = new Cart();
$result = $cartclass->manageCart($_GET, $_POST);
header('Location:cart.php');
