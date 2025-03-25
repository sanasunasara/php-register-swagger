<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->name) && !empty($data->email) && !empty($data->age)) {
    $query = "INSERT INTO users SET name=:name, email=:email, age=:age";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":name", $data->name);
    $stmt->bindParam(":email", $data->email);
    $stmt->bindParam(":age", $data->age);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User created successfully."]);
    } else {
        echo json_encode(["message" => "User creation failed."]);
    }
} else {
    echo json_encode(["message" => "Incomplete data."]);
}
