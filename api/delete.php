<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();


$data = json_decode(file_get_contents("php://input"));

if (isset($data->id) && !empty($data->id)) {
    $query = "DELETE FROM users WHERE id=:id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $data->id, PDO::PARAM_INT);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        echo json_encode(["message" => "User deleted successfully."]);
    } else {
        echo json_encode(["message" => "User not found or already deleted."]);
    }
} else {
    echo json_encode(["message" => "Incomplete data."]);
}
