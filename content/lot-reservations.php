<?php
require_once "../vendor/autoload.php";
require_once "../config/database.php";

$newReservationsTable = selectNewReservations($connection, $_SESSION["customer_id"]);
$cashSaleReservationsTable = selectCashSaleReservations($connection, $_SESSION["customer_id"]);
$sixMonthsReservationsTable = selectSixMonthsReservations($connection, $_SESSION["customer_id"]);
$installmentReservationsTable = selectInstallmentReservations($connection, $_SESSION["customer_id"]);

function generatePayMongoLink($connection, $reservationId, $reservedLot, $amount) {
    // Initialize Guzzle HTTP client
    $client = new \GuzzleHttp\Client();
  
    // Prepare data for payment link
    $data = [
        'data' => [
            'attributes' => [
                'amount' => $amount * 100,  // PayMongo expects the amount in centavos
                'description' => "Payment for " . $reservedLot,
                'remarks' => "Payment for lot reservation",
                'redirect' => [
                    'success' => "https://dwkj073hhgz8.share.zrok.io/cms-public/process/process-check-payment-status.php",
                    'failure' => "https://dwkj073hhgz8.share.zrok.io/cms-public/process/process-check-payment-status.php"
                ]
                
            ]
        ]
    ];
  
    // Make request to PayMongo to generate the payment link
    $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
        'json' => $data,
        'headers' => [
            'accept' => 'application/json',
            'authorization' => 'Basic ' . base64_encode(PAYMONGO_SECRET_KEY . ':'),
            'content-type' => 'application/json',
        ],
    ]);
  
    // Handle response and get the payment link
    $responseBody = json_decode($response->getBody(), true);
  
    // Check if the link was created successfully and retrieve the checkout URL
  if (isset($responseBody['data']['attributes']['checkout_url'])) {
    $referenceNumber = $responseBody["data"]["attributes"]["reference_number"];

    $_SESSION["active_payment_reference_number"] = $referenceNumber;
    
    $updateReferenceNumber = mysqli_prepare($connection, "UPDATE payment_terms SET reference_number = ? WHERE reservation_id = ?");
    mysqli_stmt_bind_param($updateReferenceNumber, "si", $referenceNumber, $reservationId);
    if (!mysqli_stmt_execute($updateReferenceNumber)) {
      echo "Database error";
    }
  
    $checkoutUrl = $responseBody['data']['attributes']['checkout_url'];
    // echo "Payment Link Created: <a href='$checkoutUrl' target='_blank'>Click here to pay</a>";
  } else {
    echo "Error creating payment link.";
  }
    // $checkoutUrl = $responseBody['data']['attributes']['checkout_url'];
  
    return $checkoutUrl;
}
  

function selectNewReservations($connection, $reserveeId) {
    $newReservationsTable = [];
    $reservationStatus = ["Pending", "Verified"];
    $selectNewReservations = mysqli_prepare($connection, "SELECT * FROM lot_reservations WHERE reservee_id = ? AND (reservation_status = ? OR reservation_status = ?)");
    mysqli_stmt_bind_param($selectNewReservations, "iss", $reserveeId, $reservationStatus[0], $reservationStatus[1]);
    if (mysqli_stmt_execute($selectNewReservations)) {
        $selectNewReservationsResult = mysqli_stmt_get_result($selectNewReservations);
        if (mysqli_num_rows($selectNewReservationsResult) > 0) {
            while ($newReservationRow = mysqli_fetch_assoc($selectNewReservationsResult)) {
                $newReservationRow["formatted_reserved_lot"] = displayPhaseLocation($newReservationRow["reserved_lot"]); 
                $newReservationRow["created_at"] = displayDateTime($newReservationRow["created_at"]);
                $newReservationRow["total_purchase_price"] = formatToPeso($newReservationRow["total_purchase_price"]);
                $newReservationRow["total_balance"] = formatToPeso($newReservationRow["total_balance"]);
                $newReservationRow["down_payment"] = $newReservationRow["down_payment"] != null ? formatToPeso($newReservationRow["down_payment"]) : "N/A";
                $newReservationRow["monthly_payment"] = $newReservationRow["monthly_payment"] != null ? formatToPeso($newReservationRow["monthly_payment"]) : "N/A";
                $newReservationRow["payment_options_url"] = encrypt("reservation_id=" . $newReservationRow["id"] . "&timestamp=" . time(), SECRET_KEY);
                $newReservationsTable[] = array_map("escapeOutput", $newReservationRow);
            }
        }
    }

    return $newReservationsTable;
}

function selectCashSaleReservations($connection, $reserveeId) {
    $cashSaleReservationsTable = [];
    $reservationStatus = "Active";
    $paymentOption = "Cash Sale: 10% Discount";
    $selectCashSaleReservations = mysqli_prepare($connection, "SELECT * FROM lot_reservations WHERE reservee_id = ? AND payment_option = ? AND reservation_status = ?");
    mysqli_stmt_bind_param($selectCashSaleReservations, "iss", $reserveeId, $paymentOption, $reservationStatus);
    if (mysqli_stmt_execute($selectCashSaleReservations)) {
        $selectCashSaleReservationsResult = mysqli_stmt_get_result($selectCashSaleReservations);
        if (mysqli_num_rows($selectCashSaleReservationsResult) > 0) {
            while ($cashSaleReservationRow = mysqli_fetch_assoc($selectCashSaleReservationsResult)) {
                $cashSaleReservationRow["formatted_reserved_lot"] = displayPhaseLocation($cashSaleReservationRow["reserved_lot"]);
                $cashSaleReservationRow["created_at"] = displayDateTime($cashSaleReservationRow["created_at"]);
                $cashSaleReservationRow["total_purchase_price"] = formatToPeso($cashSaleReservationRow["total_purchase_price"]);
                $cashSaleReservationRow["amount_to_pay"] = $cashSaleReservationRow["total_balance"];
                $cashSaleReservationRow["total_balance"] = formatToPeso($cashSaleReservationRow["total_balance"]);
                $cashSaleReservationRow["payment_link"] = generatePayMongoLink($connection, $cashSaleReservationRow["id"], $cashSaleReservationRow["formatted_reserved_lot"], $cashSaleReservationRow["amount_to_pay"]);
    
                $cashSaleReservationsTable[] = array_map("escapeOutput", $cashSaleReservationRow);     
            }
        }
    }
     else {
        echo "Database error";
        exit;
    }

    return $cashSaleReservationsTable;
}

function selectSixMonthsReservations($connection, $reserveeId) {
    $sixMonthsReservationsTable = [];
    $reservationStatus = "Active";
    $paymentOption = "6 Months: 5% Discount";
    $selectSixMonthsReservations = mysqli_prepare($connection, "SELECT * FROM lot_reservations WHERE reservee_id = ? AND payment_option = ? AND reservation_status = ?");
    mysqli_stmt_bind_param($selectSixMonthsReservations, "iss", $reserveeId, $paymentOption, $reservationStatus);
    if (mysqli_stmt_execute($selectSixMonthsReservations)) {
        $selectSixMonthsReservationsResult = mysqli_stmt_get_result($selectSixMonthsReservations);
        if (mysqli_num_rows($selectSixMonthsReservationsResult) > 0) {
            while ($sixMonthsReservationRow = mysqli_fetch_assoc($selectSixMonthsReservationsResult)) {
                $sixMonthsReservationRow["formatted_reserved_lot"] = displayPhaseLocation($sixMonthsReservationRow["reserved_lot"]);
                $sixMonthsReservationRow["created_at"] = displayDateTime($sixMonthsReservationRow["created_at"]);
                $sixMonthsReservationRow["total_purchase_price"] = formatToPeso($sixMonthsReservationRow["total_purchase_price"]);
                $sixMonthsReservationRow["total_balance"] = formatToPeso($sixMonthsReservationRow["total_balance"]);      
                $sixMonthsReservationsTable[] = array_map("escapeOutput", $sixMonthsReservationRow);          
            }
        }
    }
     else {
        echo "Database error";
        exit;
    }

    return $sixMonthsReservationsTable;
}

function selectInstallmentReservations($connection, $reserveeId) {
    $installmentReservationsTable = [];
    $reservationStatus = "Active";
    $paymentOption = "Installment";
    $selectInstallmentReservations = mysqli_prepare($connection, "SELECT * FROM lot_reservations WHERE reservee_id = ? AND payment_option LIKE CONCAT(?, '%') AND reservation_status = ?");
    mysqli_stmt_bind_param($selectInstallmentReservations, "iss", $reserveeId, $paymentOption, $reservationStatus);
    if (mysqli_stmt_execute($selectInstallmentReservations)) {
        $selectInstallmentReservationsResult = mysqli_stmt_get_result($selectInstallmentReservations);
        if (mysqli_num_rows($selectInstallmentReservationsResult) > 0) {
            while ($installmentReservationRow = mysqli_fetch_assoc($selectInstallmentReservationsResult)) {
                $installmentReservationRow["formatted_reserved_lot"] = displayPhaseLocation($installmentReservationRow["reserved_lot"]);
                $installmentReservationRow["created_at"] = displayDateTime($installmentReservationRow["created_at"]);
                $installmentReservationRow["total_purchase_price"] = formatToPeso($installmentReservationRow["total_purchase_price"]);
                $installmentReservationRow["total_balance"] = formatToPeso($installmentReservationRow["total_balance"]);                
                $installmentReservationRow["down_payment"] = formatToPeso($installmentReservationRow["down_payment"]);
                $installmentReservationRow["monthly_payment"] = formatToPeso($installmentReservationRow["monthly_payment"]);
                $installmentReservationsTable[] = array_map("escapeOutput", $installmentReservationRow);
            }
        }
    }
     else {
        echo "Database error";
        exit;
    }

    return $installmentReservationsTable;
}
