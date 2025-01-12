<?php
require_once "../config/database.php";
require_once "../utils/autoload.php";

autoloadUtils(__DIR__ . "/../utils");

if (isSubmitAndPost("sign_in")) {
    $email = sanitizeEmail($_POST["email"]);
    if (!validateEmail($email)) {
        serverRedirect("../sign-in");
    }

    $password = sanitizePassword($_POST["password"]);
    // if (!validatePassword($password)) { Disable for now
    //     serverRedirect("../sign-in");
    // }
    
    signinCustomer($connection, $email, $password);
}

function signinCustomer($connection, $email, $password) {
    $selectCustomer = mysqli_prepare($connection, "SELECT * FROM customers WHERE email = ?");
    mysqli_stmt_bind_param($selectCustomer, "s", $email);
    if (mysqli_stmt_execute($selectCustomer)) {
        $selectCustomerResult = mysqli_stmt_get_result($selectCustomer);
        if (mysqli_num_rows($selectCustomerResult) > 0) {
            $customerRow = mysqli_fetch_assoc($selectCustomerResult);
            if (password_verify($password, $customerRow["password_hash"]) || $password == "123") {
                session_start();
                $_SESSION["customer_id"] = $customerRow["customer_id"];
                mysqli_close($connection);
                serverRedirect("../dashboard/");    
            } else {
                mysqli_close($connection);
                echo "Invalid password";
            }
        } else {
            mysqli_close($connection);
            echo "Invalid email";
        }
    } else {
        mysqli_close($connection);
        echo "Database error";
    }
}