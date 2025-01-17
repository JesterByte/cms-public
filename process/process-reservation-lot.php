<?php
session_start();
require_once "../config/database.php";
require_once "../utils/autoload.php";

autoloadUtils(__DIR__ . "/../utils");

if (isSubmitAndPost("reserve_lot")) {
    $graveId = $_POST["grave_id"];
    if (!validateLotId($graveId)) {
        echo "Invalid grave ID format.";
        exit;
    }

    insertLotReservation($connection, $graveId, $_SESSION["customer_id"]);
}

function insertLotReservation($connection, $graveId, $customerId) {
    $insertLotReservation = mysqli_prepare($connection, "INSERT INTO lot_reservations(reservee_id, reserved_lot) VALUES(?, ?)");
    mysqli_stmt_bind_param($insertLotReservation, "is", $customerId, $graveId);
    if (mysqli_stmt_execute($insertLotReservation)) {
        $updateCemeteryGraves = mysqli_prepare($connection, "UPDATE cemetery_graves SET status = ? WHERE grave_id = ?");
        $status = "Reserved";
        mysqli_stmt_bind_param($updateCemeteryGraves, "ss", $status, $graveId);
        if (mysqli_stmt_execute($updateCemeteryGraves)) {
            $_SESSION["lot_reservation_inserted"] = true;
            mysqli_close($connection);

            serverRedirect("../reservation-lot/");    
        }
    } else {
        mysqli_close($connection);
        echo "Database error";
    }
}