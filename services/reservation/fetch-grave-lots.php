<?php
header('Content-Type: application/json');
// Database connection
include_once "../../database-connection.php";

// Fetch available grave lots from the database
$sql = "SELECT grave_id, latitude_start, longitude_start, latitude_end, longitude_end, status 
        FROM cemetery_graves 
        WHERE status = 'Available'";

$result = $connection->query($sql);

$graveLots = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $graveLots[] = [
            'grave_id' => $row['grave_id'],
            'lat_start' => $row['latitude_start'],
            'lng_start' => $row['longitude_start'],
            'lat_end' => $row['latitude_end'],
            'lng_end' => $row['longitude_end'],
            'status' => $row['status']
        ];
    }
} else {
    $graveLots = [];  // No available lots
}

echo json_encode($graveLots);  // Return data as JSON
$connection->close();
?>
