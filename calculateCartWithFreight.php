<?php
require_once(__DIR__ . '/Models/Database.php');

$db = new Database();


$ruleId = $_GET['id'] ?? null;
$cartId = $_SESSION['cartId'] ?? session_id();

if (!$ruleId || !$cartId) {
    echo json_encode(["error" => "Missing data"]);
    exit;
}

$freightRule = $db->getShippingOption($ruleId);
$freightCost = 0;

$totalWeight = $db->getTotalWeight($cartId);
$cartTotal = $db->getCartCount($cartId);

if (
    $freightRule->free_shipping_threshold > 0 &&
    $totalWeight >= $freightRule->free_shipping_threshold
) {
    $freightCost = 0;
} else {
    $freightCost = $freightRule->base_fee +
        ($freightRule->weight_modifier * $totalWeight);
}

echo json_encode([
    "cartItems" => $db->getCartItems($cartId),
    "cartTotalPrice" => $cartTotal + $freightCost,
    "cartTotalWeight" => $totalWeight,
    "freightCost" => $freightCost
]);