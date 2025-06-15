<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = (int) $_POST['product_id'];

    // Initialize the wishlist array if not already set
    if (!isset($_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = [];
    }

    // Only add if the product isn't already in the wishlist
    if (!in_array($productId, $_SESSION['wishlist'])) {
        $_SESSION['wishlist'][] = $productId;
    }

    // Redirect back to where the request came from
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    // Redirect to homepage if accessed incorrectly
    header('Location: index.php');
    exit;
}
