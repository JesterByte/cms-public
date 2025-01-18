<?php
session_start();
require_once "../config/database.php";
require_once "../utils/autoload.php";

autoloadUtils(__DIR__ . "/../utils");

if (isSubmitAndPost("confirm_payment_option")) {
    $reservationId = isset($_POST["reservation_id"]) ? decrypt($_POST["reservation_id"], SECRET_KEY) : false;
    if (!$reservationId) {
        echo "Invalid Reservation ID";
    }

    $paymentOption = isset($_POST["payment_option"]) && validatePaymentOption($_POST["payment_option"]) ? $_POST["payment_option"] : false;
    if (!$paymentOption) {
        echo "Invalid payment option";
    }

    updatePaymentOption($connection, $reservationId, $paymentOption);
}

function updatePaymentOption($connection, $reservationId, $paymentOption) {
    $selectReservation = mysqli_prepare($connection, "SELECT * FROM lot_reservations WHERE id = ?");
    mysqli_stmt_bind_param($selectReservation, "s", $reservationId);
    if (mysqli_stmt_execute($selectReservation)) {
        $selectReservationResult = mysqli_stmt_get_result($selectReservation);
        if (mysqli_num_rows($selectReservationResult) > 0) {
            $reservationRow = mysqli_fetch_assoc($selectReservationResult);
        } else {
            echo "No result";
        }
    } else {
        echo "Database error";
    }

    $paymentOptionColumns = ["Cash Sale: 10% Discount" => "cash_sale_10_discount", "6 Months: 5% Discount" => "6_months_5_discount", "Installment: 1 Year" => "monthly_amortization_1yr", "Installment: 2 Years" => "monthly_amortization_2yrs_10_interest", "Installment: 3 Years" => "monthly_amortization_3yrs_15_interest", "Installment: 4 Years" => "monthly_amortization_4yrs_20_interest", "Installment: 5 Years" => "monthly_amortization_5yrs_25_interest"];
    $phaseNumber = "Phase " . extractPhaseNumber($reservationRow["reserved_lot"]);
    $selectPricing = mysqli_prepare($connection, "SELECT * FROM phase_price_list WHERE phase = ? AND lot_type = ?");
    mysqli_stmt_bind_param($selectPricing, "ss", $phaseNumber, $reservationRow["lot_type"]);
    if (mysqli_stmt_execute($selectPricing)) {
        $selectPricingResult = mysqli_stmt_get_result($selectPricing);
        if (mysqli_num_rows($selectReservationResult) > 0) {
            $pricingRow = mysqli_fetch_assoc($selectPricingResult);
        } else {
            echo "No result";
        }
    } else {
        echo "Database error";
    }

    $reservationStatus = "Active";
    if ($paymentOption == "Cash Sale: 10% Discount" || $paymentOption == "6 Months: 5% Discount") {
        $totalBalance = $paymentOption == "Cash Sale: 10% Discount" ? $pricingRow["cash_sale_10_discount"] : $pricingRow["6_months_5_discount"];
        $updatePaymentOption = mysqli_prepare($connection, "UPDATE lot_reservations SET payment_option = ?, total_purchase_price = ?, total_balance = ?, reservation_status = ? WHERE id = ?");
        mysqli_stmt_bind_param($updatePaymentOption, "sddsi", $paymentOption,$pricingRow["total_purchase_price"], $totalBalance, $reservationStatus,  $reservationId);
    } else {
        switch ($paymentOption) {
            case "Installment: 1 Year (0% Interest)":
                $interestRate = 0.00;
                $monthlyKey = "monthly_amortization_1yr";
                break;
            case "Installment: 2 Years (10% Interest)":
                $interestRate = 0.10;
                $monthlyKey = "monthly_amortization_2yrs_10_interest";
                break;
            case "Installment: 3 Years (15% Interest)":
                $interestRate = 0.15;
                $monthlyKey = "monthly_amortization_3yrs_15_interest";
                break;
            case "Installment: 4 Years (20% Interest)":
                $interestRate = 0.20;
                $monthlyKey = "monthly_amortization_4yrs_20_interest";
                break;
            case "Installment: 5 Years (25% Interest)":
                $interestRate = 0.25;
                $monthlyKey = "monthly_amortization_5yrs_25_interest";
                break;
            default:
                $interestRate = 0.0;
                $monthlyKey = null;
                break;
        }

        $totalBalance = $pricingRow["balance"] * (1 + $interestRate);
        $monthlyPayment = $pricingRow[$monthlyKey];
        $updatePaymentOption = mysqli_prepare($connection, "UPDATE lot_reservations SET payment_option = ?, total_purchase_price = ?, down_payment = ?, monthly_payment = ?, total_balance = ?, reservation_status = ? WHERE id = ?");
        mysqli_stmt_bind_param($updatePaymentOption, "sddddsi", $paymentOption, $pricingRow["total_purchase_price"], $pricingRow["down_payment_20"], $monthlyPayment, $totalBalance, $reservationStatus, $reservationId);
    }

    if (mysqli_stmt_execute($updatePaymentOption)) {
        $_SESSION["payment_option_updated"] = true;
        serverRedirect("../lot-reservations/?type=new");
    } else {
        echo "Database error";
    }
}