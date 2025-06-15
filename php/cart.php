<?php
session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = intval($_POST['product_id'] ?? 0);

    if ($productId > 0) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]++;
        } else {
            $_SESSION['cart'][$productId] = 1;
        }

        $response['success'] = true;
        $response['message'] = 'Item added to cart';
    } else {
        $response['message'] = 'Invalid product ID';
    }

    echo json_encode($response);
    exit;
}
?>
