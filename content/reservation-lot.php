<?php
header('Content-Type: application/json');
include_once "../config/database.php";

// Fetch grave data
$sql = "SELECT grave_id, latitude_start, longitude_start, latitude_end, longitude_end, status FROM cemetery_graves WHERE status = 'Available'";
$result = $connection->query($sql);

$graves = [];
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $graves[] = $row;
  }
}

// Return the grave data as JSON
echo json_encode($graves);

$connection->close();
?>
