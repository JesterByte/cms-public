<?php

function isSubmitAndPost($submitButtonName) {
    return isset($_POST[$submitButtonName]) && $_SERVER["REQUEST_METHOD"] === "POST";
}

function validateLotId($lotId) {
    $pattern = "/^P\d+-C\d+L\d+$/";

    if (preg_match($pattern, $lotId)) {
        return true;
    } else {
        return false;
    }
}

function validateLotType($lotType) {
    return in_array($lotType, ["Supreme", "Special", "Standard"]); // Np pending
}

function expiredTimestamp($timestamp, $expiration) {
    return (time() - $timestamp) > $expiration;
}

function validatePaymentOption($paymentOption) {
    return in_array($paymentOption, ["Cash Sale: 10% Discount", "6 Months: 5% Discount", "Installment: 1 Year (0% Interest)", "Installment: 2 Years (10% Interest)", "Installment: 3 Years (15% Interest)", "Installment: 4 Years (20% Interest)", "Installment: 5 Years (25% Interest)", "Pending"]);
}