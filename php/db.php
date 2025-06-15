<?php
$host = 'localhost';
$db   = 'abc_retail';
$user = 'root';
$pass = '';  // Replace with your actual MySQL password
$port = 3307;

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
