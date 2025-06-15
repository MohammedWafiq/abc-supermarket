<?php
include 'php/db.php';
include 'php/functions.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header('Location: index.php');
  exit;
}

$id = intval($_GET['id']);
$stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
  echo "Product not found.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php echo htmlspecialchars($product['name']); ?> | ABC Retail Supermarket</title>
<link rel="stylesheet" href="css/styles.css" />
  <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
      * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Montserrat', sans-serif;
    }

    body {
      background-color: #fff;
      color: #4a4a4a;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .container {
      width: 90%;
      max-width: 1400px;
      margin: auto;
    }

    .product-detail {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
  margin: 3rem auto;
  align-items: flex-start;
  border: 1px solid #eee;
  border-radius: 12px;
  padding: 2rem;
  background-color: #fafafa;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.product-detail img {
  width: 100%;
  max-width: 400px;
  border-radius: 10px;
  object-fit: cover;
  flex: 1 1 350px;
  background: #fff;
}

.product-detail > div {
  flex: 1 1 400px;
}

.product-detail h2 {
  font-size: 2rem;
  margin-bottom: 1rem;
  color: #222;
}

.product-detail p {
  line-height: 1.6;
  margin-bottom: 1rem;
  color: #555;
}

.product-detail .price {
  font-size: 1.5rem;
  color: #00c853;
  font-weight: bold;
  margin-bottom: 1.5rem;
}

.product-detail form button {
  padding: 0.75rem 1.5rem;
  font-size: 1rem;
  background-color: #00c853;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.product-detail form button:hover {
  background-color: #009f42;
}

    header {
      background: #fff;
      color: #000;
      padding: 1rem 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid #eee;
    }

    .logo {
      font-weight: 600;
      text-align: left;
    }

    .logo span {
      display: block;
      font-size: 0.75rem;
      letter-spacing: 0.2rem;
    }

    .logo a {
      text-decoration: none;
      color: #000;
      font-size: 1.5rem;
    }

    .search-bar {
      flex-grow: 1;
      margin: 0 2rem;
      display: flex;
      align-items: center;
    }

    .search-bar input {
      width: 100%;
      padding: 0.75rem 1rem 0.75rem 2.5rem;
      border-radius: 12px;
      border: 1px solid #ccc;
      background-color: #f5f6f7;
      font-size: 1rem;
      background-image: url('https://cdn-icons-png.flaticon.com/512/622/622669.png');
      background-size: 16px;
      background-repeat: no-repeat;
      background-position: 10px center;
    }

    .header-icons {
      display: flex;
      align-items: center;
      gap: 2rem;
      font-size: 0.95rem;
    }

    .header-icons a {
      color: #000;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .header-icons a i {
      font-size: 1.2rem;
    }

    .cart-icon {
      position: relative;
    }

    .cart-badge {
      position: absolute;
      top: -8px;
      right: -10px;
      background: #00c853;
      color: white;
      border-radius: 50%;
      font-size: 0.7rem;
      padding: 2px 6px;
    }

      footer {
      background: #111;
      color: #fff;
      font-size: 0.9rem;
      padding: 2rem;
      margin-top: auto;
    }

    footer .footer-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 2rem;
      max-width: 1400px;
      margin: auto;
    }

    footer .footer-column {
      flex: 1 1 200px;
    }

    footer .footer-column h4 {
      margin-bottom: 1rem;
      font-size: 1.1rem;
      font-weight: 600;
    }

    footer .footer-column ul {
      list-style: none;
    }

    footer .footer-column ul li {
      margin-bottom: 0.5rem;
    }

    footer .footer-column ul li a {
      color: #fff;
      text-decoration: none;
    }

    footer .footer-column ul li a:hover {
      text-decoration: underline;
    }

    .footer-bottom {
      text-align: center;
      margin-top: 2rem;
      border-top: 1px solid #444;
      padding-top: 1rem;
      font-size: 0.8rem;
      color: #bbb;}
</style>

</head>
<body>
<header class="container">
  <div class="logo">
    <span>ABC</span>
    <a href="index.php">Retail Supermarket</a>
  </div>

  <div class="search-bar" style="position: relative; flex-grow: 1; margin: 0 2rem;">
    <form id="search-form" action="search.php" method="GET" style="width: 100%;" autocomplete="off">
      <input type="text" id="search-input" name="query" placeholder="Search for products..." required />
    </form>
    <div id="search-results" style="
      position: absolute; 
      top: 100%; 
      left: 0; 
      right: 0; 
      background: #fff; 
      border: 1px solid #ccc; 
      border-top: none;
      max-height: 300px; 
      overflow-y: auto; 
      z-index: 9999;
      display: none;
    ">
      <!-- Results will appear here -->
    </div>
  </div>

  <div class="header-icons">
    <?php if (!isLoggedIn()): ?>
      <a href="login.php"><i class="fas fa-user"></i> Sign In</a>
    <?php else: ?>
      <span>Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    <?php endif; ?>

    <a href="wishlist.php"><i class="fas fa-heart"></i> Wishlist</a>


    <a href="cart.php" class="cart-icon">
      <i class="fas fa-shopping-bag"></i>
      <span class="cart-badge"><?php echo cartItemCount(); ?></span>
    </a>
  </div>
</header>


<main class="container">
  <div class="product-detail">
    <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
    <div>
      <h2><?php echo htmlspecialchars($product['name']); ?></h2>
      <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
      <p class="price">AED <?php echo number_format($product['price'], 2); ?></p>

      <form class="add-to-cart-form">
  <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
  <button type="submit" name="add_to_cart">Add to Cart</button>
</form>

    </div>
  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(form);

      fetch('php/cart.php', {
        method: 'POST',
        body: formData
      }).then(response => {
        if (response.ok) {
          // Optional: Show a success message
          alert("Item added to cart!");
        } else {
          alert('Failed to add item to cart.');
        }
      }).catch(() => {
        alert('An error occurred.');
      });
    });
  });
});
</script>


<footer>
  <div class="footer-container">
    <div class="footer-column">
      <h4>ABC Retail Supermarket</h4>
      <p>Fresh Fruits, Vegetables & unbeatable groceries deals make ABC Retail Supermarket your top choice for quality and convenience, Fresh to your Doorstep</p>
    </div>
    <div class="footer-column">
      <h4>My Account</h4>
      <ul>
        <li><a href="#">About</a></li>
        <li><a href="#">Delivery Info</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms & Conditions</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h4>Support</h4>
      <ul>
        <li><a href="#">Contact</a></li>
        <li><a href="#">FAQs</a></li>
        <li><a href="#">Returns</a></li>
        <li><a href="#">Blogs</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h4>Categories</h4>
      <ul>
        <li><a href="#">Fruits</a></li>
        <li><a href="#">Vegetables</a></li>
        <li><a href="#">Food Cupboard</a></li>
        <li><a href="#">Flowers Box</a></li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2025 ABC Retail Supermarket - UAE</strong></p>
  </div>
</footer>
</body>
</html>