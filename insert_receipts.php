<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $date = $_POST["date"];
    $received_from = $_POST["received_from"];
    $or_number = $_POST["or_number"];
    $purpose = $_POST["purpose"];
    $amount = $_POST["amount"];

    try {
        $stmt = $pdo->prepare("INSERT INTO receipts (date, received_from, or_number, purpose, amount) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$date, $received_from, $or_number, $purpose, $amount]);

        echo "<script>
                alert('Receipt record added successfully!');
                window.location.href = 'receipts.html';
              </script>";
    } catch (PDOException $e) {
        echo "<script>
                alert('Error adding record: " . $e->getMessage() . "');
                window.history.back();
              </script>";
    }
}
?>