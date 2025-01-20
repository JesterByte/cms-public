<?php
session_start();
require_once "../config/database.php";
require_once "../vendor/autoload.php";
require_once "../utils/autoload.php";

autoloadUtils(__DIR__ . "/../utils");

// Assume you've received the payment details
$linkId = isset($_SESSION["active_payment_reference_number"]) ? $_SESSION["active_payment_reference_number"] : "dNDxaR9";  // Example payment ID

// Check payment status
$paymentStatus = checkPaymentStatus($linkId);

// Update the database or take necessary action
if ($paymentStatus === 'paid') {
    // Payment was successful, mark reservation as paid
    $query = "UPDATE payment_terms SET status = 'Paid' WHERE reference_number = ?";
    $stmt = $connection->prepare($query);
    $stmt->execute([$linkId]);
} else {
    // Payment status still pending
    echo "Payment status is still pending.";
}


function checkPaymentStatus($linkId) {
    $client = new \GuzzleHttp\Client();

    $response = $client->request('GET', "https://api.paymongo.com/v1/links/{$linkId}", [
        'headers' => [
            'accept' => 'application/json',
            'authorization' => 'Basic ' . base64_encode( PAYMONGO_SECRET_KEY .':'),
        ],
    ]);

    $paymentData = json_decode($response->getBody(), true);

    return $paymentData['data']['attributes']['status'];  // Return the payment status
}
