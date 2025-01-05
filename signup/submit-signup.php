<?php
include_once "../database-connection.php";
include_once "../sanitation.php";

if (isset($_POST["submit_button"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $username = sanitizeUsername($_POST["username"]);
    if (!$username) {
        header("Location: ../signup/?error=invalid-username");
        exit();
    }

    $email = sanitizeEmail($_POST["email"]);
    if (!validateEmail($email)) {
        header("Location: ../signup/?error=invalid-email&username=$username");
        exit();
    }

    if ($_POST["password"] !== $_POST["confirm_password"]) {
        header("Location: ../signup/?error=password-mismatch&username=$username&email=$email");
        exit();
    }

    if (validatePassword($_POST["password"])) {
        $password = $_POST["password"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    } else {
        header("Location: ../signup/?error=invalid-password&username=$username&email=$email");
        exit();
    }

    $insertCustomer = mysqli_prepare($connection, "INSERT INTO customers (username, email, password_hash) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($insertCustomer, "sss", $username, $email, $hashedPassword);
    if (mysqli_stmt_execute($insertCustomer)) {
        header("Location: ../login/");
        exit();
    } else {
        header("Location: ../signup/?error=sql-error&username=$username&email=$email");
        exit();
    }
}