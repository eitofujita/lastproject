<?php
require_once '../config/db.php';

header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'] ?? '';
$password = password_hash($data['password'] ?? '', PASSWORD_DEFAULT);
$email = $data['email'] ?? '';

if ($username && $password && $email) {
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password, $email]);
    echo json_encode(["status" => "ok"]);
} else {
    http_response_code(400);
    echo json_encode(["error" => "Missing data"]);
}
?>
