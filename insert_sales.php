<?php
require_once 'db.php';

// Get JSON input
$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
    exit;
}

$date = date('Y-m-d');
$received_from = $data->received_from;
$or_number = $data->or_number;
$purpose = $data->purpose;
$amount = $data->amount;
$created_at = date('Y-m-d H:i:s');

try {
    $stmt = $pdo->prepare("INSERT INTO reseipts (date, received_from, or_number, purpose, amount, created_at) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$date, $received_from, $or_number, $purpose, $amount, $created_at]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
