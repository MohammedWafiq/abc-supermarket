<?php
include 'php/db.php';
include 'php/functions.php';
include 'php/auth.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = sanitize($_POST['username']);
  $email = sanitize($_POST['email']);
  $password = $_POST['password'];
  $password_confirm = $_POST['password_confirm'];

  if ($password !== $password_confirm) {
    $error = 'Passwords do not match.';
  } else {
    $result = registerUser($username, $email, $password);
    if ($result === true) {
      $success = 'Registration successful! You can now <a href="login.php">login</a>.';
    } else {
      $error = $result;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | ABC Retail Supermarket</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Montserrat', sans-serif;
    }
    body {
      margin: 0;
      display: flex;
      height: 100vh;
    }
    .register-container {
      display: flex;
      width: 100%;
    }
    .form-side {
      flex: 1;
      padding: 60px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .form-side h2 {
      margin-bottom: 10px;
      font-size: 32px;
    }
    .form-side p {
      margin-bottom: 30px;
      color: #555;
    }
    form input[type="text"],
    form input[type="email"],
    form input[type="password"] {
      width: 100%;
      padding: 12px 15px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }
    form button {
      width: 100%;
      padding: 12px;
      background-color: #2979ff;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      margin-bottom: 20px;
    }
    .message {
      padding: 10px;
      border-radius: 4px;
      margin-bottom: 20px;
    }
    .error {
      background-color: #f8d7da;
      color: #842029;
    }
    .success {
      background-color: #d1e7dd;
      color: #0f5132;
    }
    .form-side a {
      color: #2979ff;
      text-decoration: none;
    }
    .image-side {
      flex: 1;
      background: url('images/login.jpg') center center/cover no-repeat;
    }

    @media (max-width: 768px) {
      .register-container {
        flex-direction: column;
      }
      .image-side {
        height: 300px;
      }
    }
  </style>
</head>
<body>

<!-- Logo/Header -->
<div style="position: absolute; top: 20px; left: 40px;">
  <div style="font-size: 12px; letter-spacing: 4px; font-weight: 400;">A B C</div>
  <div style="font-size: 22px; font-weight: 600;">Retail Supermarket</div>
</div>

<div class="register-container">
  <div class="form-side">
    <h2>Create an Account</h2>
    <p>Start your journey with ABC Retail Supermarket</p>

    <?php if ($error): ?>
      <div class="message error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="message success"><?php echo $success; ?></div>
    <?php else: ?>
      <form method="post">
        <input type="text" name="username" placeholder="Username" required />
        <input type="email" name="email" placeholder="Email address" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="password" name="password_confirm" placeholder="Confirm Password" required />
        <button type="submit">Register</button>
      </form>
    <?php endif; ?>

    <p>Already have an account? <a href="login.php">Sign in here</a>.</p>
  </div>
  <div class="image-side"></div>
</div>

</body>
</html>
