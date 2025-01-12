<?php
// Decrypt the data from the URL
$encryptedData = $_GET['data']; // Get the encrypted data from the URL
$decryptedData = decrypt($encryptedData, SECRET_KEY);

// Now, you can extract the timestamp from the decrypted data
parse_str($decryptedData, $params); // Parse the decrypted data into key-value pairs
$receivedTimestamp = $params['timestamp'];

// Validate the timestamp (example: ensure it's not too old)
if (time() - $receivedTimestamp > 300) { // 5 minutes expiration window
    echo "This link has expired.";
    exit;
}

// Rest of your logic
echo "Valid request!";

// Decrypt function
function decrypt($data, $key) {
    // Decode the base64 data
    $data = base64_decode($data);

    // Extract the IV and encrypted data
    $iv = substr($data, 0, 16); // The first 16 bytes is the IV
    $encryptedData = substr($data, 16); // The rest is the encrypted data

    // Decrypt the data
    return openssl_decrypt($encryptedData, 'AES-256-CBC', $key, 0, $iv);
}
?>
