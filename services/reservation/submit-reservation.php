<?php
include_once "../../database-connection.php";
include_once "../../sanitation.php";

if (isset($_POST["submit_button"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = sanitizeName($_POST["first_name"]);

    if (empty($_POST["middle_name"])) {
        $middleName = "";
    } else {
        $middleName = sanitizeName($_POST["middle_name"]);
    }

    $lastName = sanitizeName($_POST["last_name"]);

    if (empty($_POST["suffix"])) {
        $suffix = "";
    } else {
        $suffix = sanitizeSuffix($_POST["suffix"]);
    }

    if (!$suffix) {
        echo "Invalid suffix"; // Redirect to the form page
        exit();
    }

    $email = sanitizeEmail($_POST["email"]);

    if (!validateEmail($email)) {
        echo "Invalid email"; // Redirect to the form page
        exit();
    }

    $phoneNumber = sanitizePhoneNumber($_POST["phone"]);

    if (!$phoneNumber) {
        echo "Invalid phone number"; // Redirect to the form page
        exit();
    }

    $graveLot = sanitizeGraveLot($_POST["grave_lot"]);

    if (!$graveLot) {
        echo "Invalid grave lot"; // Redirect to the form page
        exit();
    }

    if (empty($_POST["reservation_notes"])) {
        $reservationNotes = "";
    } else {
        $reservationNotes = sanitizeNotes($_POST["reservation_notes"]);
    }

    $insertReservation = mysqli_prepare($connection, "INSERT INTO grave_reservations(first_name, middle_name, last_name, suffix, email, phone, grave_lot, reservation_notes) VALUES(?,?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($insertReservation, "ssssssss", $firstName, $middleName, $lastName, $suffix, $email, $phoneNumber, $graveLot, $reservationNotes);
    if (mysqli_stmt_execute($insertReservation)) {
        echo "Reservation submitted successfully"; // Redirect to the form page
    } else {
        echo "Error submitting reservation"; // Redirect to the form page
    }
}