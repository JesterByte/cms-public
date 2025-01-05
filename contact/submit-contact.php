<?php
include_once "../../database-connection.php";
include_once "../../sanitation.php";

if (isset($_POST["submit_button"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = sanitizeName($_POST["name"]);

    $email = sanitizeEmail($_POST["email"]);

    if (!validateEmail($email)) {
        echo "Invalid email"; // Redirect to the form page
        exit();
    }

    $message = sanitizeNotes($_POST["message"]);

    $insertContactForm = mysqli_prepare($connection, "INSERT INTO contact_form_submissions (name, email, message) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($insertContactForm, "sss", $fullName, $email, $message);
    if (mysqli_stmt_execute($insertContactForm)) {
        echo "Form submitted successfully"; // Redirect to the form page
    } else {
        echo "Error submitting form"; // Redirect to the form page
    }
}