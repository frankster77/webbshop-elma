<?php
ob_start();
session_start();
use Stripe\Stripe;
include_once 'vendor/autoload.php';
include_once 'Models/Database.php';
$db = new Database();
$cartItems = $db->getCartItems($_SESSION['cartId']);


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

$lineItems = [];
foreach ($cartItems as $item) {
    $lineItems[] = [
        'price_data' => [
            'currency' => 'usd',
            'product_data' => [
                'name' => $item['name'],
                'images' => [$item['imgUrl']],
            ],
            'unit_amount' => $item['price'] * 100,
        ],
        'quantity' => $item['quantity'],
    ];
}

$checkoutSession = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => $lineItems,
    'mode' => 'payment',
    'success_url' => 'http://localhost:8000/success.php',
    'cancel_url' => 'http://localhost:8000/cart.php',
    'locale' => 'auto',
]);

http_response_code(303);
header('Location: ' . $checkoutSession->url);
exit;

?>