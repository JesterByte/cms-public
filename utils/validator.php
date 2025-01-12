<?php

function isSubmitAndPost($submitButtonName) {
    return isset($_POST[$submitButtonName]) && $_SERVER["REQUEST_METHOD"] === "POST";
}

function validateLotId($graveId) {
    $pattern = "/^P\d+-C\d+G\d+$/";

    if (preg_match($pattern, $graveId)) {
        return true;
    } else {
        return false;
    }
}

function validateLotType($lotType) {
    return in_array($lotType, ["Supreme", "Special", "Standard"]); // Np pending
}

function validateTimestamp($timestamp, $expiration) {
    return (time() - $timestamp) > $expiration;
}