<?php
require 'db_connect.php';

$search = $_GET['search'] ?? '';



if ($search) {
    $stmt = $pdo->prepare("SELECT * FROM receipts WHERE received_from LIKE ? OR purpose LIKE ? ORDER BY date DESC");
    $stmt->execute(["%$search%", "%$search%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM receipts ORDER BY date DESC");
}

$receipts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>receipts List</title>
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
  <input type="text" name="search" placeholder="Supplier or item..." value="<?= htmlspecialchars($search) ?>" 
         style="padding: 0.5rem; width: 300px; border-radius: 5px; border: 1px solid #ccc;">
  <button type="submit" style="padding: 0.5rem 1rem; background: #2563eb; color: white; border: none; border-radius: 5px;">
    Search
  </button>
  <button type="submit" style="padding: 0.5rem 1rem; background: #2563eb; color: white; border: none; border-radius: 5px;">
  <a href="view_receipts.php" style="margin-left: 0rem; text-decoration: none; color:rgb(255, 255, 255);">Clear</a>
</button>
</form>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Received From</th>
        <th>OR Number</th>
        <th>Purpose</th>
        <th>Amount </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($receipts as $receipt): ?>
        <tr>
          <td><?= htmlspecialchars($receipt['id']) ?></td>
          <td><?= htmlspecialchars($receipt['received_from']) ?></td>
          <td><?= htmlspecialchars($receipt['or_number']) ?></td>
          <td><?= htmlspecialchars($receipt['purpose']) ?></td>
          <td>₱ <?= htmlspecialchars(number_format($receipt['amount'], 2)) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <a href="receipts.html" class="back-btn">← Back to Receipts Form</a>

</body>
</html>
