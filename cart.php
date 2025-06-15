<?php
include 'php/db.php';
include 'php/functions.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Shopping Cart | ABC Retail</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
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
      color: #bbb;
    }
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
      <input type="text" name="query" placeholder="Search for products..." required />
    </form>
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

<main class="container" style="display: flex; flex-wrap: wrap; gap: 2rem; margin-top: 2rem;">
  <?php
  if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0): ?>
    <p>Your cart is empty.</p>
  <?php else:
    $cart = $_SESSION['cart'];
    $total = 0;
    $discount = 0;

    $validCoupon = 'RAMADAN15';
    if (isset($_POST['apply_coupon']) && !empty($_POST['coupon_code'])) {
        $enteredCode = strtoupper(trim($_POST['coupon_code']));
        if ($enteredCode === $validCoupon) {
            $discount = 0.15;
        }
    }
  ?>
  <div style="flex: 2; min-width: 300px;">
    <?php foreach ($cart as $productId => $qty):
      $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
      $stmt->execute([$productId]);
      $product = $stmt->fetch();
      if (!$product) continue;
      $subtotal = $product['price'] * $qty;
      $total += $subtotal;
    ?>
    <div style="display: flex; gap: 1rem; padding: 1rem; border: 1px solid #eee; border-radius: 12px; margin-bottom: 1rem; background: #fff;">
      <div style="width: 140px; height: 140px; background: white; display: flex; align-items: center; justify-content: center; border-radius: 12px; border: 1px solid #eee;">
  <img src="images/<?php echo htmlspecialchars($product['image']); ?>" 
       alt="<?php echo htmlspecialchars($product['name']); ?>" 
       style="max-width: 100%; max-height: 100%; object-fit: contain;">
</div>

      <div style="flex: 1;">
        <h3 style="margin: 0;"><?php echo htmlspecialchars($product['name']); ?></h3>
        <p style="color: green; margin: 0.2em 0;">Get it <strong>Tomorrow</strong></p>
        <p style="margin: 0.2em 0;">Sold by <strong>ABC Retail</strong></p>
        <div style="margin: 0.3em 0;">
          <span style="background: #90ee90; padding: 2px 6px; border-radius: 5px; font-size: 0.85rem;">express</span>
          <span style="margin-left: 1em;"><i class="fa fa-shipping-fast"></i> Free Delivery</span>
        </div>
        <div style="margin-top: 0.5em;">
          <strong>AED <?php echo number_format($product['price'], 2); ?></strong> x 
          <input type="number" name="quantities[<?php echo $productId; ?>]" value="<?php echo $qty; ?>" min="1" style="width: 60px; padding: 2px 5px;">
        </div>
        <div style="margin-top: 0.5em;">Subtotal: <strong>AED <?php echo number_format($subtotal, 2); ?></strong></div>
        <div style="margin-top: 0.5em;">
          <form method="post" action="php/cart.php" onsubmit="return confirm('Remove this item?');">
            <input type="hidden" name="product_id" value="<?php echo $productId; ?>" />
            <button type="submit" name="remove_item" value="1" style="background: none; border: none; color: red; cursor: pointer;">
              <i class="fa fa-trash"></i> Remove
            </button>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <div style="flex: 1; min-width: 280px; padding: 1rem; background: #f9f9f9; border-radius: 12px; border: 1px solid #eee;">
    <h3>Order Summary</h3>
    <form method="post" action="">
      <div style="margin-bottom: 0.5em;">
        <input type="text" name="coupon_code" placeholder="Enter coupon code" style="padding: 0.5rem; width: 70%; border: 1px solid #ccc; border-radius: 5px;">
        <button type="submit" name="apply_coupon" style="padding: 0.5rem;">Apply</button>
      </div>
    </form>
    <?php if ($discount > 0): ?>
      <div style="color: green; font-size: 0.9rem;">Coupon applied! 15% off.</div>
    <?php endif; ?>
    <div style="margin: 1em 0;">
      <p>Subtotal: AED <?php echo number_format($total, 2); ?></p>
      <?php if ($discount > 0): ?>
        <p>Discount (15%): AED <?php echo number_format($total * $discount, 2); ?></p>
      <?php endif; ?>
      <p>Shipping Fee: <strong style="color: green;">FREE</strong></p>
    </div>
    <div style="font-size: 1.1rem; font-weight: bold;">
      Total: AED <?php echo number_format($total * (1 - $discount), 2); ?>
    </div>
    <div style="margin-top: 1.5em;">
      <a href="checkout.php" style="display: block; background: #1a73e8; color: white; padding: 0.75rem; text-align: center; border-radius: 8px; text-decoration: none;">CHECKOUT</a>
    </div>
  </div>
  <?php endif; ?>
</main>

<footer>
  <div class="footer-container">
    <div class="footer-column">
      <h4>Customer Service</h4>
      <ul>
        <li><a href="#">Help Center</a></li>
        <li><a href="#">Returns</a></li>
        <li><a href="#">Track Order</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h4>About Us</h4>
      <ul>
        <li><a href="#">Company Info</a></li>
        <li><a href="#">Careers</a></li>
        <li><a href="#">Privacy Policy</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h4>Contact</h4>
      <ul>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">Locations</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; 2025 ABC Retail Supermarket - UAE. All rights reserved.
  </div>
</footer>

<script>
  document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('change', function () {
      const productId = this.name.match(/\d+/)[0];
      const quantity = this.value;

      fetch('php/update_cart_ajax.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `product_id=${productId}&quantity=${quantity}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          location.reload();
        }
      });
    });
  });
</script>
</body>
</html>
