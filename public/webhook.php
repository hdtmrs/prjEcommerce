<?php

$payload = @file_get_contents('php://input');
file_put_contents('log.txt', $payload);

try {
    $event = \Stripe\Event::constructFrom(
        json_decode($payload, true)
    );
} catch(\UnexpectedValueException $e) {
    
    http_response_code(400);
    exit();
}

if ($endpoint_secret) {
  
  $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
  try {
    $event = \Stripe\Webhook::constructEvent(
      $payload, $sig_header, $endpoint_secret
    );
  } catch(\Stripe\Exception\SignatureVerificationException $e) {
    
    echo '⚠️  Webhook error while validating signature.';
    http_response_code(400);
    exit();
  }
}

// Handle the event
switch ($event->type) {
    case 'payment_intent.succeeded':
        $paymentIntent = $event->data->object; 
        file_put_contents('log.txt', $event);
        break;
    case 'payment_method.attached':
        $paymentMethod = $event->data->object;
        file_put_contents('log.txt', $event);
        break;
    
    default:
        echo 'Received unknown event type ' . $event->type;
}

