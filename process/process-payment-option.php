<?php
require_once "../config/database.php";
require_once "../utils/autoload.php";

autoloadUtils(__DIR__ . "/../utils");

if (isSubmitAndPost("confirm_payment_option")) {
    //
}