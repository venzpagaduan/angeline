<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $customer = $_POST["customer_name"];
    $item = $_POST["item_description"];
    $amount = $_POST["amount"];
    $date = $_POST["date"];

    try {
        $stmt = $pdo->prepare("INSERT INTO sales (customer_name, item_description, amount, date) VALUES (?, ?, ?, ?)");
        $stmt->execute([$customer, $item, $amount, $date]);

        // After successful insert, show a JS alert
        echo "<script>
                alert('Sale record added successfully!');
                window.location.href = 'sales.html'; // Redirect back to form
              </script>";
    } catch (PDOException $e) {
        echo "<script>
                alert('Error adding record: " . $e->getMessage() . "');
                window.history.back();
              </script>";
    }
}
?>