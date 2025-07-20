<?php 

require '../vendor/autoload.php';

use Stripe\StripeClient;
use app\library\Cart;

session_start();

$private_key = '#';

$stripe = new StripeClient($private_key);

$cart = new Cart;
$productInCart = $cart->getCart();

$items = [
    'mode' => 'payment',
    'success_url' => 'http://localhost:8000/success.php',
    'cancel_url' => 'http://localhost:8000/cancel.php',
];

foreach ($productInCart as $product) {
    $items['line_items'][] = [
        'price_data' => [
            'currency' => 'brl',
            'product_data' => [
                'name' => $product->getName()
            ],
            'unit_amount' => $product->getPrice()
        ],
        'quantity' => $product->getQuantity()
    ];
}

$checkout_session = $stripe->checkout->sessions->create($items);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
?>