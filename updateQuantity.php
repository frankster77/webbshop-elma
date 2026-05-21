<?php
ob_start();
session_start();

include_once 'Models/Database.php';
$db = new Database();

if (isset($_GET['productId']) && isset($_GET['action']) && isset($_SESSION['cartId'])) {

    $productId = $_GET['productId'];
    $action = $_GET['action'];
    $cartId = $_SESSION['cartId'];

    // Hämta alla produkter i cart
    $cartItems = $db->getCartItems($cartId);

    foreach ($cartItems as $item) {

        if ($item['productId'] == $productId) {

            $newQuantity = $item['quantity'];

            // Plus 
            if ($action === "plus") {
                $newQuantity++;
            }

            // Minus
            if ($action === "minus") {
                $newQuantity--;
            }

            // Om quantity är 0 så tas produkten bort från varukorgen
            if ($newQuantity <= 0) {

                $db->deleteCartItem($cartId, $productId);

            } else {

                // Uppdatera quantity i databasen
                $db->updateQuantity($cartId, $productId, $newQuantity);
            }

            break;
        }
    }
}

header("Location: cart.php");
exit();
?>