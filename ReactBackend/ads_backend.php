<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$dbname = "nepnews";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Connection failed: " . $conn->connect_error]));
}

$request_method = $_SERVER['REQUEST_METHOD'];
$current_time = date('Y-m-d H:i:s');

// Handle GET request for active ads
if ($request_method === 'GET') {
    // Check if requesting all ads (for admin) or active ads (for frontend)
    if (isset($_GET['all']) && $_GET['all'] === 'true') {
        $sql = "SELECT * FROM ads ORDER BY start_time DESC";
        $result = $conn->query($sql);
        $ads = [];
        while($row = $result->fetch_assoc()) {
            $ads[] = $row;
        }
        echo json_encode($ads);
    } else {
        // Get single random active ad for frontend
        $sql = "SELECT id, ad_image, redirect_link FROM ads 
                WHERE start_time <= ? AND end_time >= ? 
                ORDER BY RAND() LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $current_time, $current_time);
        $stmt->execute();
        $result = $stmt->get_result();
        echo json_encode($result->fetch_assoc() ?: null);
    }
    exit;
}

// Handle POST requests for CRUD operations
if ($request_method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($data['action'])) {
        echo json_encode(["success" => false, "error" => "No action specified"]);
        exit;
    }

    $response = ["success" => false];
    
    try {
        switch ($data['action']) {
            case 'create':
                $sql = "INSERT INTO ads (ad_image, start_time, end_time, redirect_link) 
                        VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", 
                    $data['ad_image'], 
                    $data['start_time'], 
                    $data['end_time'], 
                    $data['redirect_link']
                );
                break;
                
            case 'update':
                $sql = "UPDATE ads SET 
                        ad_image = ?, 
                        start_time = ?, 
                        end_time = ?, 
                        redirect_link = ? 
                        WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssi", 
                    $data['ad_image'], 
                    $data['start_time'], 
                    $data['end_time'], 
                    $data['redirect_link'],
                    $data['id']
                );
                break;
                
            case 'delete':
                $sql = "DELETE FROM ads WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $data['id']);
                break;
                
            case 'track_click':
                // You can implement click tracking here
                // Example: update a clicks column in your ads table
                $sql = "UPDATE ads SET clicks = clicks + 1 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $data['id']);
                $stmt->execute();
                echo json_encode(["success" => true]);
                exit;
                
            default:
                throw new Exception("Invalid action");
        }
        
        if ($stmt->execute()) {
            $response["success"] = true;
            if ($data['action'] === 'create') {
                $response["id"] = $conn->insert_id;
            }
        } else {
            $response["error"] = $conn->error;
        }
    } catch (Exception $e) {
        $response["error"] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit;
}

$conn->close();
?>