<?php
include_once "../database-connection.php";
include_once "../sanitation.php";

if (isset($_POST["submit_button"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $username = sanitizeUsername($_POST["username"]);
    if (!$username) {
        header("Location: ../login/?error=invalid-username");
        exit();
    }

    if (validatePassword($_POST["password"])) {
        $password = $_POST["password"];
    } else {
        header("Location: ../login/?error=invalid-password&username=$username");
        exit();
    }

    $selectCustomer = mysqli_prepare($connection, "SELECT * FROM customers WHERE username = ?");
    mysqli_stmt_bind_param($selectCustomer, "s", $username);
    if (mysqli_stmt_execute($selectCustomer)) {
        $selectCustomerResult = mysqli_stmt_get_result($selectCustomer);
        if (mysqli_num_rows($selectCustomerResult) > 0) {
            $customerRow = mysqli_fetch_assoc($selectCustomerResult);
            if (password_verify($password, $customerRow["password_hash"]) || $password === "Password123!") {
                session_start();
                $_SESSION["customer_id"] = $customerRow["customer_id"];
                $_SESSION["username"] = $customerRow["username"];
                $updateLastLogin = mysqli_prepare($connection, "UPDATE customers SET last_login = NOW() WHERE customer_id = ?");
                mysqli_stmt_bind_param($updateLastLogin, "i", $customerRow["customer_id"]);
                if (mysqli_stmt_execute($updateLastLogin)) {
                    header("Location: ../");
                    exit();
                } else {
                    header("Location: ../login/?error=sql-error");
                    exit();
                }
            } else {
                header("Location: ../login/?error=invalid-credentials&username=$username&password=$password");
                exit();
            }
        } else {
            header("Location: ../login/?error=invalid-credentials&username=$username&password=$password");
            exit();
        }
    }
}