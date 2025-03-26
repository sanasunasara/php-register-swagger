<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id) && !empty($data->name) && !empty($data->email) && !empty($data->age)) {
    $query = "UPDATE users SET name=:name, email=:email, age=:age WHERE id=:id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":id", $data->id);
    $stmt->bindParam(":name", $data->name);
    $stmt->bindParam(":email", $data->email);
    $stmt->bindParam(":age", $data->age);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User updated successfully."]);
    } else {
        echo json_encode(["message" => "User update failed."]);
    }
} else {
    echo json_encode(["message" => "Incomplete data."]);
}
