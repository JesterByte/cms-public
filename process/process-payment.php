<?php
require_once('../vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
    'body' => json_encode([
        'data' => [
            'attributes' => [
                'amount' => $amountInCentavos, // Send the amount in centavos
                'description' => 'Reservation Payment',
                'remarks' => 'Green Haven Memorial Park',
            ]
        ]
    ]),
    'headers' => [
        'accept' => 'application/json',
        'authorization' => 'Basic sk_test_RRS7JuGU9Ude1aYr8ucFZYwH',
        'content-type' => 'application/json',
    ],
]);

$responseBody = json_decode($response->getBody(), true);

echo "Payment Link ID: " . $responseBody['data']['id'];
