<?php
session_start();

include_once 'Models/Database.php';

$db = new Database();

if (isset($_GET['productId']) && isset($_SESSION['cartId'])) {

    $productId = $_GET['productId'];
    $cartId = $_SESSION['cartId'];

    // Tar bort hela produkten från varukorgen
    $db->deleteCartItem($cartId, $productId);
}

header("Location: cart.php");
exit();