<?php
include 'php/db.php';

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if ($query === '') {
    echo json_encode([]);
    exit;
}

// Prepared statement to prevent injection, searching by product name
$stmt = $pdo->prepare("SELECT id, name, image FROM products WHERE name LIKE ? LIMIT 10");
$stmt->execute(['%' . $query . '%']);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
