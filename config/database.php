<?php
$hostName = "localhost";
$serverUsername = "root";
$serverPassword = "";
$databaseName = "cms_db";

$connection = mysqli_connect($hostName, $serverUsername, $serverPassword, $databaseName);

if (!$connection) {
    die("Connection error");
}