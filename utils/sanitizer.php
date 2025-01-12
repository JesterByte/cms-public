<?php
function sanitizeEmail($email) {
    // Sanitize email
    $email = trim($email);
    $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    return $sanitizedEmail;
}

function validateEmail($email) {
    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function sanitizePassword($password) {
    // Sanitize password by trimming whitespace
    $sanitizedPassword = trim($password);
    return $sanitizedPassword;
}

function validatePassword($password) {
    // Validate password (at least 8 characters, at least one lowercase letter, one uppercase letter, one digit, and one special character)
    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    if (preg_match($pattern, $password)) {
        return true;
    } else {
        return false;
    }
}