<?php
require_once "../config/database.php";
require_once "../utils/helpers.php";

$pendingReservationsTable = selectPendingReservations($connection, $_SESSION["customer_id"]);

function selectPendingReservations($connection, $reserveeId) {
    $pendingReservationsTable = [];
    $reservationStatus = "Pending";
    $selectPendingReservations = mysqli_prepare($connection, "SELECT * FROM lot_reservations WHERE reservee_id = ? AND reservation_status = ?");
    mysqli_stmt_bind_param($selectPendingReservations, "is", $reserveeId, $reservationStatus);
    if (mysqli_stmt_execute($selectPendingReservations)) {
        $selectPendingReservationsResult = mysqli_stmt_get_result($selectPendingReservations);
        if (mysqli_num_rows($selectPendingReservationsResult) > 0) {
            while ($myReservationRow = mysqli_fetch_assoc($selectPendingReservationsResult)) {
                $myReservationRow["formatted_reserved_lot"] = displayPhaseLocation($myReservationRow["reserved_lot"]); 
                $myReservationRow["created_at"] = displayDateTime($myReservationRow["created_at"]);
                $myReservationRow["total_purchase_price"] = formatToPeso($myReservationRow["total_purchase_price"]);
                $myReservationRow["total_balance"] = formatToPeso($myReservationRow["total_balance"]);
                $myReservationRow["down_payment"] = $myReservationRow["down_payment"] != null ? formatToPeso($myReservationRow["down_payment"]) : "N/A";
                $myReservationRow["monthly_payment"] = $myReservationRow["monthly_payment"] != null ? formatToPeso($myReservationRow["monthly_payment"]) : "N/A";
                $myReservationRow["payment_options_url"] = encrypt("reservation_id=" . $myReservationRow["id"] . "&timestamp=" . time(), SECRET_KEY);
                $pendingReservationsTable[] = array_map("escapeOutput", $myReservationRow);
            }
        }
    }

    return $pendingReservationsTable;
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
                $cashSaleReservationRow["total_balance"] = formatToPeso($cashSaleReservationRow["total_balance"]);                
            }
        } else {
            echo "No result";
            exit;
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
            }
        } else {
            echo "No result";
            exit;
        }
    }
     else {
        echo "Database error";
        exit;
    }

    return $sixMonthsReservationsTable;
}

function installmentReservations($connection, $reserveeId) {
    $installmentReservationsTable = [];
    $reservationStatus = "Active";
    $paymentOption = "Installment";
    $installmentReservations = mysqli_prepare($connection, "SELECT * FROM lot_reservations WHERE reservee_id = ? AND payment_option LIKE CONCAT(?, '%') AND reservation_status = ?");
    mysqli_stmt_bind_param($installmentReservations, "iss", $reserveeId, $paymentOption, $reservationStatus);
    if (mysqli_stmt_execute($installmentReservations)) {
        $installmentReservationsResult = mysqli_stmt_get_result($installmentReservations);
        if (mysqli_num_rows($installmentReservationsResult) > 0) {
            while ($installmentReservationRow = mysqli_fetch_assoc($installmentReservationsResult)) {
                $installmentReservationRow["formatted_reserved_lot"] = displayPhaseLocation($installmentReservationRow["reserved_lot"]);
                $installmentReservationRow["created_at"] = displayDateTime($installmentReservationRow["created_at"]);
                $installmentReservationRow["total_purchase_price"] = formatToPeso($installmentReservationRow["total_purchase_price"]);
                $installmentReservationRow["total_balance"] = formatToPeso($installmentReservationRow["total_balance"]);                
                $installmentReservationRow["down_payment"] = formatToPeso($installmentReservationRow["down_payment"]);
                $installmentReservationRow["monthly_payment"] = formatToPeso($installmentReservationRow["monthly_payment"]);
            }
        } else {
            echo "No result";
            exit;
        }
    }
     else {
        echo "Database error";
        exit;
    }

    return $installmentReservationsTable;
}
