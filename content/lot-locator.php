<?php
header('Content-Type: application/json');
include_once "../config/database.php";

// Fetch lot data
$sql = "SELECT lot_id, latitude_start, longitude_start, latitude_end, longitude_end, status FROM cemetery_lots";
$result = $connection->query($sql);

$lots = [];
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $lots[] = $row;
  }
}

// Return the grave data as JSON
echo json_encode($lots);

$connection->close();
?>
