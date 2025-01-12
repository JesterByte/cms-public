<?php
require_once "../config/database.php";
require_once "../utils/helpers.php";

$myReservationsTable = selectMyReservations($connection, $_SESSION["customer_id"]);

function selectMyReservations($connection, $reserveeId) {
    $myReservationsTable = [];
    $selectMyReservations = mysqli_prepare($connection, "SELECT * FROM lot_reservations WHERE reservee_id = ?");
    mysqli_stmt_bind_param($selectMyReservations, "i", $reserveeId);
    if (mysqli_stmt_execute($selectMyReservations)) {
        $selectMyReservationsResult = mysqli_stmt_get_result($selectMyReservations);
        if (mysqli_num_rows($selectMyReservationsResult) > 0) {
            while ($myReservationRow = mysqli_fetch_assoc($selectMyReservationsResult)) {
                $myReservationRow["formatted_reserved_lot"] = displayPhaseLocation($myReservationRow["reserved_lot"]); 
                $myReservationRow["created_at"] = displayDateTime($myReservationRow["created_at"]);
                $myReservationRow["lot_price"] = formatToPeso($myReservationRow["lot_price"]);
                $myReservationRow["payment_options_url"] = encrypt("reservation_id=" . $myReservationRow["id"] . "&timestamp=" . time(), SECRET_KEY);
                $myReservationsTable[] = array_map("escapeOutput", $myReservationRow);
            }
        }
    }

    return $myReservationsTable;
}
