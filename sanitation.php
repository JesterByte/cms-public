<?php

function sanitizeName($name) {
    // Trim whitespace from the beginning and end of the string
    $name = trim($name);

    // Remove any unwanted characters, e.g., HTML tags or special characters
    // Allow letters, spaces, hyphens, and apostrophes only
    $name = preg_replace("/[^a-zA-Z\s\-']/u", "", $name); 

    // Optionally, convert name to proper case (capitalize first letters of each word)
    $name = ucwords(strtolower($name));

    return $name;
}

function sanitizeSuffix($suffix) {
    // Trim whitespace from the beginning and end of the string
    $suffix = trim($suffix);

    // Remove any unwanted characters, e.g., HTML tags or special characters
    // Allow letters and periods only
    $suffix = preg_replace("/[^a-zA-Z\.]/u", "", $suffix); 

    // Optionally, convert suffix to uppercase
    $suffix = strtoupper($suffix);

    if (in_array($suffix, ["Jr.", "Sr.", "I", "II", "III", "IV"])) {
        return $suffix;
    } else {
        return false; // Invalid suffix
    }
}

function sanitizeEmail($email) {
    // Trim whitespace from the beginning and end of the string
    $email = trim($email);

    // Remove unwanted characters (spaces, newlines, etc.)
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    return $email;
}

function validateEmail($email) {
    // Validate email format using PHP's built-in filter_var function
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function sanitizePhoneNumber($phone) {
    // Remove non-numeric characters (except for "+" symbol)
    $phone = preg_replace('/[^\d\+]/', '', $phone);

    // Optionally, you can ensure that the phone number starts with a country code (e.g., +639 for the Philippines)
    if (substr($phone, 0, 4) != '+639') {
        // Optionally handle the error (e.g., throw an exception, return false, etc.)
        return false;
    }

    return $phone;
}

function validatePhoneNumber($phone) {
    // Validate the phone number using a length check (e.g., 13 digits including the country code)
    // This example assumes +639 + 9 digits (total length of 13 digits)
    return strlen($phone) == 13;  // 13 characters for +639 + 9 digits
}

function sanitizeGraveLot($lot) {
    // Remove any unwanted characters (keep only alphanumeric and dashes)
    $sanitizedLot = preg_replace('/[^a-zA-Z0-9\-]/', '', $lot);

    // Ensure the format matches "P{number}-C{number}G{number}"
    if (preg_match('/^P\d+-C\d+G\d+$/', $sanitizedLot)) {
        return $sanitizedLot;
    }

    // Return false if the lot does not match the expected format
    return false;
}

function sanitizeNotes($notes) {
    // Remove all HTML tags and convert special characters to HTML entities
    $sanitizedNotes = strip_tags($notes);
    $sanitizedNotes = htmlspecialchars($sanitizedNotes, ENT_QUOTES, 'UTF-8');
    return $sanitizedNotes;
}

function sanitizeUsername($username) {
    // Remove disallowed characters
    $username = preg_replace('/[^a-zA-Z0-9._]/', '', $username);
    
    // Ensure it starts with a letter
    if (!preg_match('/^[a-zA-Z]/', $username)) {
        return false; // Invalid username
    }

    // Ensure no consecutive special characters (e.g., ".." or "__")
    if (preg_match('/[._]{2,}/', $username)) {
        return false; // Invalid username
    }

    // Enforce length limits
    if (strlen($username) < 3 || strlen($username) > 20) {
        return false; // Invalid username
    }

    return $username;
}

function validatePassword($password) {
    // Minimum 8, maximum 64 characters, at least one uppercase, one lowercase, one number, and one special character
    $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,64}$/';
    if (!preg_match($pattern, $password)) {
        return false; // Invalid password
    }
    return true; // Valid password
}