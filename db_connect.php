<?php
$host = 'sql12.freesqldatabase.com';
$db = 'sql12773707';
$user = 'sql12773707';
$pass = 'cCsEigKhzd'; // Leave blank for XAMPP default
$port = 3306;
$charset = 'utf8mb4';



try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $port);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
