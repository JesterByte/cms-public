<?php
session_start();

unsetToast("lot_reservation_inserted");
unsetToast("payment_option_updated");

function unsetToast($sessionKey) {
    if (isset($_SESSION[$sessionKey]) && $_SESSION[$sessionKey] === true) {
        unset($_SESSION[$sessionKey]);
    }
}