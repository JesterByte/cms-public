<?php
session_start();
require_once "../config/database.php";
require_once "../utils/autoload.php";

autoloadUtils(__DIR__ . "/../utils");

if (isSubmitAndPost("reserve_lot")) {
    $lotId = $_POST["lot_id"];
    if (!validateLotId($lotId)) {
        echo "Invalid lot ID format.";
        exit;
    }

    insertLotReservation($connection, $lotId, $_SESSION["customer_id"]);
}

function insertLotReservation($connection, $lotId, $customerId) {
    $insertLotReservation = mysqli_prepare($connection, "INSERT INTO lot_reservations(reservee_id, reserved_lot) VALUES(?, ?)");
    mysqli_stmt_bind_param($insertLotReservation, "is", $customerId, $lotId);
    if (mysqli_stmt_execute($insertLotReservation)) {
        $updateCemeteryLots = mysqli_prepare($connection, "UPDATE cemetery_lots SET status = ? WHERE lot_id = ?");
        $status = "Reserved";
        mysqli_stmt_bind_param($updateCemeteryLots, "ss", $status, $lotId);
        if (mysqli_stmt_execute($updateCemeteryLots)) {
            $_SESSION["lot_reservation_inserted"] = true;
            mysqli_close($connection);

            serverRedirect("../lot-reservations/?type=new");    
        }
    } else {
        mysqli_close($connection);
        echo "Database error";
    }
}