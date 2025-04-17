<?php
require 'db_connect.php';

$search = $_GET['search'] ?? '';

if ($search) {
    $stmt = $pdo->prepare("SELECT * FROM sales WHERE customer_name LIKE ? OR item_description LIKE ? ORDER BY date DESC");
    $stmt->execute(["%$search%", "%$search%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM sales ORDER BY date DESC");
}

$sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sales List</title>
  <style>
    table {
      width: 90%;
      margin: 2rem auto;
      border-collapse: collapse;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 1rem;
      border: 1px solid #ccc;
      text-align: left;
    }
    th {
      background-color: #f3f4f6;
    }
    h2 {
      text-align: center;
      margin-top: 2rem;
    }
    a.back-btn {
      display: block;
      width: fit-content;
      margin: 1rem auto;
      text-decoration: none;
      background: #2563eb;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <h2>Sales Records</h2>

<form method="get" style="text-align: center; margin-bottom: 1.5rem;">
  <input type="text" name="search" placeholder="Search by customer or item..." value="<?= htmlspecialchars($search) ?>" 
         style="padding: 0.5rem; width: 300px; border-radius: 5px; border: 1px solid #ccc;">
  <button type="submit" style="padding: 0.5rem 1rem; background: #2563eb; color: white; border: none; border-radius: 5px;">
    Search
  </button>
  <button type="submit" style="padding: 0.5rem 1rem; background: #2563eb; color: white; border: none; border-radius: 5px;">
  <a href="view_sales.php" style="margin-left: 0rem; text-decoration: none; color:rgb(255, 255, 255);">Clear</a>
</button>
</form>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Item</th>
        <th>Amount</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($sales as $sale): ?>
        <tr>
          <td><?= htmlspecialchars($sale['id']) ?></td>
          <td><?= htmlspecialchars($sale['customer_name']) ?></td>
          <td><?= htmlspecialchars($sale['item_description']) ?></td>
          <td>$<?= htmlspecialchars($sale['amount']) ?></td>
          <td><?= htmlspecialchars($sale['date']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <a href="sales.html" class="back-btn">← Back to Sales Form</a>

</body>
</html>
