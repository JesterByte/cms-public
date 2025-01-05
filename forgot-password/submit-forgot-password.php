<?php
session_start();
include_once "../database-connection.php";
include_once "../sanitation.php";
include_once "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["submit_button_1"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    // $email = sanitizeEmail($_POST["email"]);
    $email = "ejjose94@gmail.com";

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../forgot-password/?error=invalid-email");
        exit();
    }

    // Check if the email exists in the database
    $selectCustomer = mysqli_prepare($connection, "SELECT * FROM customers WHERE email = ?");
    mysqli_stmt_bind_param($selectCustomer, "s", $email);
    if (mysqli_stmt_execute($selectCustomer)) {
        $selectCustomerResult = mysqli_stmt_get_result($selectCustomer);
        if (mysqli_num_rows($selectCustomerResult) > 0) {
            $customerRow = mysqli_fetch_assoc($selectCustomerResult);
            $_SESSION["customer_id"] = $customerRow["customer_id"];

            // Generate a 6-digit OTP
            $otp = random_int(100000, 999999);

            // Save OTP and expiration time to session or database
            $_SESSION["otp"] = $otp;
            $_SESSION["otp_expiry"] = time() + 300; // OTP expires in 5 minutes

            // Send OTP via email
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Replace with your mail server
                $mail->SMTPAuth = true;
                $mail->Username = 'ejjose94@gmail.com'; // Your SMTP email
                $mail->Password = 'dzftvwdftttloqat'; // Your SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('ejjose94@gmail.com', 'Green Haven Memorial Park');
                $mail->addAddress($email, $customerRow['username']); // Customer's email and name

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Your OTP for Password Reset';
                $mail->Body = "
                    <html>
                    <head>
                        <style>
                            .email-container {
                                font-family: Arial, sans-serif;
                                color: #333;
                                text-align: center;
                                background-color: #f8f9fa;
                                padding: 20px;
                                border-radius: 10px;
                                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                                max-width: 600px;
                                margin: auto;
                            }
                            .header {
                                font-size: 24px;
                                color: #28a745;
                                font-weight: bold;
                                margin-bottom: 20px;
                            }
                            .otp {
                                font-size: 36px;
                                color: #007bff;
                                font-weight: bold;
                                margin: 20px 0;
                            }
                            .footer {
                                font-size: 12px;
                                color: #555;
                                margin-top: 20px;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='email-container'>
                            <div class='header'>Green Haven Memorial Park</div>
                            <p>Dear {$customerRow['username']},</p>
                            <p>Use the OTP below to reset your password. Please note that this OTP is valid for 5 minutes only.</p>
                            <div class='otp'>{$otp}</div>
                            <p>If you did not request a password reset, please ignore this email.</p>
                            <div class='footer'>© Green Haven Memorial Park. All rights reserved.</div>
                        </div>
                    </body>
                    </html>
                ";

                $mail->AltBody = "Dear {$customerRow['username']},\n\nYour OTP for password reset is: {$otp}\n\nIf you did not request a password reset, please ignore this email.\n\n© Green Haven Memorial Park. All rights reserved.";

                $mail->send();
                $_SESSION["step"] = 2;
                $_SESSION["email"] = $email;
                header("Location: ../forgot-password/");
                exit();
            } catch (Exception $e) {
                error_log("Mailer Error: {$mail->ErrorInfo}");
                header("Location: ../forgot-password/?error=email-failed");
                exit();
            }
        } else {
            header("Location: ../forgot-password/?error=email-not-found");
            exit();
        }
    }
} else if (isset($_POST["submit_button_2"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_SESSION["otp"] == $_POST["verification_code"] && time() < $_SESSION["otp_expiry"]) {
        $_SESSION["step"] = 3;
        header("Location: ../forgot-password/");
        exit();
    } else {
        header("Location: ../forgot-password/?error=invalid-otp");
        exit();
    }
} else if (isset($_POST["submit_button_3"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    if ($newPassword !== $confirmPassword) {
        header("Location: ../forgot-password/?error=password-mismatch");
        exit();
    }

    if (!validatePassword($newPassword)) {
        header("Location: ../forgot-password/?error=invalid-password");
        exit();
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updatePassword = mysqli_prepare($connection, "UPDATE customers SET password_hash = ? WHERE customer_id = ?");
    mysqli_stmt_bind_param($updatePassword, "si", $hashedPassword, $_SESSION["customer_id"]);
    if (mysqli_stmt_execute($updatePassword)) {
        unset($_SESSION["customer_id"]);
        unset($_SESSION["otp"]);
        unset($_SESSION["otp_expiry"]);
        unset($_SESSION["step"]);
        header("Location: ../login/");
        exit();
    } else {
        header("Location: ../forgot-password/?error=sql-error");
        exit();
    }
} else if (isset($_POST["cancel_forgot_password"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    unset($_SESSION["customer_id"]);
    unset($_SESSION["otp"]);
    unset($_SESSION["otp_expiry"]);
    unset($_SESSION["step"]);
    header("Location: ../login/");
    exit();
}
?>
