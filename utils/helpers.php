<?php
require_once "../vendor/autoload.php";

define("SECRET_KEY", "123");
define("PAYMONGO_PUBLIC_KEY", "pk_test_qSGhBShGA4DgxfErQ6k7iSQS");
define("PAYMONGO_SECRET_KEY", "sk_test_ZTA2SopEKfLJHZPZ7Tc4XKCK");
define("PAYMONGO_WEBHOOK_SECRET_KEY", "whsk_3Cx2A2jnNDTZmgZ23fRAR4Wr");

// Encrypt function
function encrypt($data, $key) { // encrypt() requires a timestamp
  $iv = openssl_random_pseudo_bytes(16); // Secure 16-byte IV
  $encryptedData = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
  return base64_encode($iv . $encryptedData); // Concatenate IV and encrypted data
}

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

function isActivePage($pageTitle, $currentPage) {
    return $pageTitle == $currentPage ? "active" : "";
}

function isAriaCurrentPage($pageTitle, $currentPage) {
    return $pageTitle == $currentPage ? 'aria-current="page"' : "";
}

function isActivePageLink($type) {
  return isset($_GET["type"]) && $_GET["type"] == $type ? "active" : "";
}

function isAriaCurrentPageLink($type) {
  return isset($_GET["type"]) && $_GET["type"] == $type ? 'aria-current="page"' : "";
}

function serverRedirect($destination) {
    header("Location: $destination");
    exit;
}

function isUnauthenticated() {
    if (!isset($_SESSION["customer_id"])) {
        serverRedirect("../sign-in");
    }
}

function isAuthenticated() {
    if (isset($_SESSION["customer_Id"])) {
        serverRedirect("../dashboard");
    }
}

function fillIcon($pageTitle, $currentPage) {
    echo $pageTitle == $currentPage ? "-fill" : "";
}
  
function isPageTitleInList($pageTitle, $titles) {
    return in_array($pageTitle, $titles);
}

function isActiveSidebarPage($pageTitle, $currentPage) {
    echo $pageTitle == $currentPage ? "text-bg-success rounded" : "";
}

function echoSessionToast($sessionKey) {
  echo json_encode(isset($_SESSION[$sessionKey]) ? true : false);
}

function displayPhaseLocation($location) {
    // Use a regular expression to parse the input
    if (preg_match('/^P(\d+)-C(\d+)L(\d+)$/', $location, $matches)) {
      $phase = $matches[1];
      $column = $matches[2];
      $lot = $matches[3];
      return "Phase $phase, Column $column, Lot $lot";
    } else {
      return "Invalid location format";
    }
}

function formatToPeso($amount) {
    return '₱' . number_format($amount, 2);
}

function tableHead($tableHead) {
  echo "<th>" . $tableHead . "</th>";
}

function startRow() {
    echo "<tr>";
}
  
function rowData($textColor = "", $rowData) {
  echo "<td class='" . $textColor . "'>" . escapeOutput($rowData) . "</td>";
}

function rowButtonTriggerModal($color = "", $modalId = "", $buttonIcon = "", $buttonText = "") {
  echo '<td><button type="button" class="btn ' . $color . '" data-bs-toggle="modal" data-bs-target="' . $modalId . '">' . $buttonIcon . ' ' . $buttonText . '</button></td>';
}

function rowButton($color = "", $icon = "", $textContent) {
    echo '<td><button type="button" class="btn ' . $color . '">' . $icon  . ' ' . escapeOutput($textContent) . '</button></td>';
}

function rowLink($color = "", $icon = "", $textContent, $link = "#", $target = "") {
  echo '<td><a class="btn ' . $color . '" href="' . $link . '" target="' . $target . '">' . $icon  . ' ' . escapeOutput($textContent) . '</a></td>';
}

function rowDataBadge($color, $rowData) {
    echo '<td><span class="badge text-bg-' . $color . '">' . escapeOutput($rowData) . '</span></td>';
}
  
function endRow() {
  echo "</tr>";
}

function escapeOutput($output) {
  return htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
}

function displayDateTime($datetime) {
  return date("m/d/Y h:i A", strtotime($datetime));
}
  
function displayDate($date) {
  return date("m/d/Y", strtotime($date));
}

function tableBadge($color, $textContent) {
    echo '<span class="badge text-bg-' . $color . '">' . $textContent . '</span>';
}

// function encodeUrlParameter($parameterValue) {
//   return urlencode(base64_encode($parameterValue));
// }

// function decodeUrlParameter($parameterValue) {
//   return urldecode(base64_decode($parameterValue));
// }

function extractPhaseNumber($lotId) {
  // Use a regular expression to find the number after 'P'
  if (preg_match('/P(\d+)-/', $lotId, $matches)) {
      return $matches[1]; // Return the first captured group (the number after 'P')
  }
  return null; // Return null if the pattern doesn't match
}

function jsAlert($message) {
  echo "<script>alert('$message');</script>";
}

function jsonSession($sessionKey) {
  echo json_encode(isset($_SESSION[$sessionKey]) &&  $_SESSION[$sessionKey] === true ? $_SESSION[$sessionKey] : false);
}

function buttonBadge($number) {
  if ($number <= 0) {
    return "";
  } else {
    return '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
      ' . $number . '
      <span class="visually-hidden">unread messages</span>
    </span>';
  }


}