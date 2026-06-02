<?php
ob_start();
session_start();
include_once 'Models/Database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'] ?? 1;

    $db = new Database();
    $cartId = $_SESSION['cartId'] ?? $db->createCart($_SESSION['userId']);
    echo $_SESSION['cartId'];
    $_SESSION['cartId'] = $cartId;


    $db->addToCart($cartId, $productId);
    header("Location: cart.php");
    exit();
}