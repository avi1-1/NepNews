<?php
header('Content-Type: application/json');

// Include database connection
include_once 'db.php';

// Get current timestamp
$currentTime = date('Y-m-d H:i:s');

// Query to fetch active ads (where the ad's time window includes the current time)
$query = "SELECT * FROM ads WHERE start_time <= ? AND end_time >= ?";

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("ss", $currentTime, $currentTime);
    $stmt->execute();
    $result = $stmt->get_result();

    $ads = [];
    while ($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }

    echo json_encode($ads);
} else {
    echo json_encode(['error' => 'Unable to fetch ad data']);
}

$stmt->close();
$conn->close();
?>
