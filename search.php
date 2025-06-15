<?php
include 'php/db.php';  // your PDO connection
include 'php/functions.php';

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if ($query === '') {
    header('Location: index.php');
    exit;
}

// Use prepared statement with LIKE for search
$stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ?");
$stmt->execute(['%' . $query . '%']);
$products = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Search Results for "<?= htmlspecialchars($query) ?>" - ABC Retail Supermarket</title>
  <style>
    /* Copy the same styles you use on categories.php to keep consistency */
    /* ... put your CSS here or link your CSS file */
  </style>
</head>
<body>
<header class="container">
  <div class="logo">
    <span>ABC</span>
    <a href="index.php">Retail Supermarket</a>
  </div>

  <div class="search-bar">
    <form action="search.php" method="GET" style="width: 100%;">
      <input type="text" name="query" placeholder="Search for products..." value="<?= htmlspecialchars($query) ?>" required />
    </form>
  </div>

  <div class="header-icons">
    <?php if (!isLoggedIn()): ?>
      <a href="login.php"><i class="fas fa-user"></i> Sign In</a>
    <?php else: ?>
      <span>Hi, <?= htmlspecialchars($_SESSION['username']); ?></span>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    <?php endif; ?>
    <a href="wishlist.php"><i class="fas fa-heart"></i> Wishlist</a>
    <a href="cart.php" class="cart-icon">
      <i class="fas fa-shopping-bag"></i>
      <span class="cart-badge"><?= cartItemCount(); ?></span>
    </a>
  </div>
</header>

<div class="container">
  <h2>Search Results for "<?= htmlspecialchars($query) ?>"</h2>
  <div class="product-grid">
    <?php if (count($products) > 0): ?>
      <?php foreach ($products as $product): ?>
        <div class="product-card">
          <a href="product.php?id=<?= $product['id'] ?>">
            <img src="images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
            <h3><?= htmlspecialchars($product['name']) ?></h3>
          </a>
          <div class="price">AED <?= number_format($product['price'], 2) ?></div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No products found matching your search.</p>
    <?php endif; ?>
  </div>
</div>

<footer>
  <!-- Copy your existing footer from categories.php here -->
</footer>

</body>
</html>
