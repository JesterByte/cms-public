<?php
require_once "../config/database.php";
require_once "../utils/autoload.php";

autoloadUtils(__DIR__ . "/../utils");

if (isset($_GET["data"])) {
    $encryptedData = $_GET["data"];
    $decryptedData = decrypt($encryptedData, SECRET_KEY);

    parse_str($decryptedData, $parameters);
    $receivedTimestamp = $parameters["timestamp"];
    if (validateTimestamp($receivedTimestamp, 300)) {
        serverRedirect("../my-reservations/");
    }
    $reservationId = $parameters["reservation_id"];
    $encryptedReservationId = encrypt($reservationId, SECRET_KEY);

    $paymentOptionsRow = selectPaymentOptions($connection, $reservationId);
}

function selectPaymentOptions($connection, $reservationId) {
    $paymentOptionsRow = [];

    $selectReservedLot = mysqli_prepare($connection, "SELECT * FROM lot_reservations WHERE id = ? LIMIT 1");
    mysqli_stmt_bind_param($selectReservedLot, "i", $reservationId);
    if (mysqli_stmt_execute($selectReservedLot)) {
        $selectReservedLotResult = mysqli_stmt_get_result($selectReservedLot);
        if (mysqli_num_rows($selectReservedLotResult) > 0) {
            $reservedLotRow = array_map("escapeOutput", mysqli_fetch_assoc($selectReservedLotResult));
        } else {
            echo "No result";
        }
    } else {
        echo "Database error";
    }

    $phaseNumber = "Phase " . extractPhaseNumber($reservedLotRow["reserved_lot"]);
    $selectPaymentOptions = mysqli_prepare($connection, "SELECT * FROM phase_price_list WHERE phase = ? AND lot_type LIKE CONCAT(?, '%') LIMIT 1");
    mysqli_stmt_bind_param($selectPaymentOptions, "ss", $phaseNumber, $reservedLotRow["lot_type"]);
    if (mysqli_stmt_execute($selectPaymentOptions)) {
        $selectPaymentOptionsResult = mysqli_stmt_get_result($selectPaymentOptions);
        if (mysqli_num_rows($selectPaymentOptionsResult) > 0) {
            $paymentOptionsRow = mysqli_fetch_assoc($selectPaymentOptionsResult);
        } else {
            echo "No result";
        }
    } else {
        echo "Database error";
    }

    $paymentOptionsRow["reserved_lot"] = $reservedLotRow["reserved_lot"];
    $paymentOptionsRow = array_map("escapeOutput", $paymentOptionsRow);
    return $paymentOptionsRow;
}