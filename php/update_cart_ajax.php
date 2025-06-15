<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['quantity'])) {
    $productId = (int)$_POST['product_id'];
    $quantity = max(1, (int)$_POST['quantity']);

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = $quantity;
        echo json_encode(['success' => true]);
        exit;
    }
}

echo json_encode(['success' => false]);
