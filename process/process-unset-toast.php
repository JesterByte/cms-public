<?php
session_start();

unsetToast("lot_reservation_inserted");

function unsetToast($sessionKey) {
    if (isset($_SESSION[$sessionKey]) && $_SESSION[$sessionKey] === true) {
        unset($_SESSION[$sessionKey]);
    }
}