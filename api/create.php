<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");


include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

// Get JSON input or try $_POST
$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    $data = $_POST; // Try form-data
}

// Validate input
if (!empty($data['name']) && !empty($data['email']) && !empty($data['age'])) {
    $query = "INSERT INTO users (name, email, age) VALUES (:name, :email, :age)";
    $stmt = $db->prepare($query);

    // Bind parameters
    $stmt->bindParam(":name", $data['name']);
    $stmt->bindParam(":email", $data['email']);
    $stmt->bindParam(":age", $data['age']);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User created successfully."]);
    } else {
        echo json_encode(["message" => "User creation failed."]);
    }
} else {
    echo json_encode(["message" => "Incomplete data.", "received_data" => $data]);
}
