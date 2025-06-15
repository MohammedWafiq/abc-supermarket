<?php
include 'php/db.php';
include 'php/functions.php';
include 'php/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = sanitize($_POST['email']);
  $password = $_POST['password'];

  if (loginUser($email, $password)) {
    header('Location: index.php');
    exit;
  } else {
    $error = 'Invalid email or password.';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | ABC Retail Supermarket</title>
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
    .login-container {
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
    .error {
      background-color: #f8d7da;
      color: #842029;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 4px;
    }
    .form-side a {
      color: #2979ff;
      text-decoration: none;
    }
    .image-side {
      flex: 1;
      background: url('images/login.jpg') center center/cover no-repeat;
    }
    .social-login {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
    }
    .social-btn {
      flex: 1;
      padding: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f1f1f1;
      border: 1px solid #ccc;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      transition: background-color 0.3s;
    }
    .social-btn:hover {
      background-color: #e2e2e2;
    }
    .social-btn img {
      height: 20px;
      margin-right: 8px;
    }

    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
      }
      .image-side {
        height: 300px;
      }
    }
  </style>
</head>
<body>
  <div style="position: absolute; top: 20px; left: 40px;">
  <div style="font-size: 12px; letter-spacing: 4px; font-weight: 400;">A B C</div>
  <div style="font-size: 22px; font-weight: 600;">Retail Supermarket</div>
</div>


<div class="login-container">
  <div class="form-side">
    <h2>Sign In to ABC Retail</h2>
    <p>Start shopping for fresh produce today</p>

    <?php if ($error): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
      <input type="email" name="email" placeholder="Email address" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>

    <div style="text-align: center; margin: 20px 0; color: #999;">or sign in with</div>

    <div class="social-login">
      <div class="social-btn"><img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook">Facebook</div>
      <div class="social-btn"><img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">Google</div>
      <div class="social-btn"><img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple">Apple</div>
    </div>

    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
  </div>
  <div class="image-side"></div>
</div>

</body>
</html>
