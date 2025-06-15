<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';

function registerUser($name, $email, $password) {
  global $pdo;

  // Check if email already registered
  $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
  $stmt->execute([$email]);
  if ($stmt->fetch()) {
    return 'Email already registered';
  }

  // Insert user WITHOUT hashing password (plaintext)
  $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
  $stmt->execute([$name, $email, $password]);
  return true;
}

function loginUser($email, $password) {
  global $pdo;

  // Get user by email
  $stmt = $pdo->prepare('SELECT id, name, password FROM users WHERE email = ?');
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  // Check password directly (no hashing)
  if ($user && $password === $user['password']) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['name'];
    return true;
  }
  return false;
}
?>
