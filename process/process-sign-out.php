<?php
include_once "../utils/helpers.php";

signoutCustomer();

function signoutCustomer() {
    session_start();
    $_SESSION = [];
    session_destroy();
    serverRedirect("../sign-in");
}