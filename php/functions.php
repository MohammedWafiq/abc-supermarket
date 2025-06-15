<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn() {
  return isset($_SESSION['user_id']);
}

function requireLogin() {
  if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
  }
}

function sanitize($data) {
  return htmlspecialchars(trim($data));
}

function cartItemCount() {
  if (!isset($_SESSION['cart'])) return 0;
  return array_sum($_SESSION['cart']);
}



?>
