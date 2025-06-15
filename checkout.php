<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'php/db.php';
include 'php/functions.php';

requireLogin();

$cart = $_SESSION['cart'] ?? [];

if (!$cart) {
    header('Location: cart.php');
    exit;
}

$message = '';
$discountPercent = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $_SESSION['cart'] = [];
    $message = 'Thank you for your order! Your order has been placed successfully.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Checkout | ABC Retail</title>
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
        .checkout-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-top: 1.5rem;
        }
        .checkout-left, .checkout-right {
            background: #fff;
            border: 1px solid #ddd;
            padding: 1.5rem;
            border-radius: 8px;
        }
        .checkout-left {
            flex: 2;
            min-width: 300px;
        }
        .checkout-right {
            flex: 1;
            min-width: 280px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .address-box, .order-box, .payment-box {
            border: 1px solid #ddd;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
        }
        .order-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            padding: 0.5rem 0;
        }
        .order-item img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            margin-right: 10px;
        }
        .price {
            font-weight: bold;
        }
        .badge {
            background: #ffc107;
            color: #000;
            padding: 2px 6px;
            font-size: 12px;
            border-radius: 4px;
            margin-left: 8px;
        }
        .promo-code input {
            width: 60%;
            padding: 5px;
            margin-right: 10px;
        }
        .promo-code button {
            padding: 5px 10px;
        }
        .payment-methods label {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .payment-methods input[type="radio"] {
            margin-right: 10px;
        }
        .place-order-btn {
            background-color: #ddd;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 6px;
            margin-top: 1rem;
            cursor: pointer;
        }
        .place-order-btn:hover {
            background-color: #bbb;
        }
        .security-note {
            font-size: 12px;
            color: #666;
            margin-top: 1rem;
        }
        .card-details {
            margin-top: 10px;
            display: none;
        }
        .card-details input {
            display: block;
            margin-bottom: 8px;
            width: 100%;
            padding: 6px;
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

<main class="container">
  <h2>Checkout</h2>

  <?php if ($message): ?>
    <p class="message"><?php echo $message; ?></p>
    <p><a href="index.php">Back to shopping</a></p>
  <?php else: ?>
  <form method="post" id="checkout-form">
    <div class="checkout-container">

      <div class="checkout-left">
        <div class="section-title">Shipping Address</div>
        <div class="address-box">
          <label for="address">Address:</label><br>
          <textarea name="address" id="address" rows="3" required></textarea><br><br>
          <label for="phone">Phone Number:</label><br>
          <input type="tel" name="phone" id="phone" required>
        </div>

        <div class="section-title">Your Order</div>
        <div class="order-box">
          <?php
          $total = 0;
          foreach ($cart as $product_id => $qty):
              $stmt = $pdo->prepare('SELECT name, price, image FROM products WHERE id = ?');
              $stmt->execute([$product_id]);
              $product = $stmt->fetch();
              if (!$product) continue;
              $subtotal = $product['price'] * $qty;
              $total += $subtotal;
          ?>
          <div class="order-item">
            <div style="display: flex; align-items: center;">
              <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
              <?php echo htmlspecialchars($product['name']); ?>
              <span class="badge">x<?php echo $qty; ?></span>
            </div>
            <div style="text-align: right;">
              <div class="price">AED <?php echo number_format($product['price'], 2); ?></div>
              <div style="font-size: 0.85rem; color: #555;">Total: AED <?php echo number_format($subtotal, 2); ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="section-title">Payment</div>
        <div class="payment-box payment-methods">
          <label><input type="radio" name="payment_method" value="card" required> Debit/Credit Card</label>
          <label><input type="radio" name="payment_method" value="cod"> Payment on Delivery</label>
          <div class="card-details" id="card-details">
            <input type="text" name="card_number" placeholder="Card Number">
            <input type="text" name="card_name" placeholder="Card Holder Name">
            <input type="text" name="card_expiry" placeholder="Expiry Date (MM/YY)">
            <input type="text" name="card_cvv" placeholder="CVV">
          </div>
        </div>
      </div>

      <div class="checkout-right">
        <div class="section-title">Order Summary</div>
        <div class="order-box">
          <p>Subtotal: AED <?php echo number_format($total, 2); ?></p>
          <p>Shipping Fee: <span style="color: green;">FREE</span></p>
          <div id="total-amount"><strong>Total Incl. VAT: AED <?php echo number_format($total, 2); ?></strong></div>
          <div class="promo-code">
            <input type="text" id="promo" name="promo" placeholder="Enter promo code">
            <button type="button" id="apply-promo">Apply</button>
            <p id="promo-message" style="color: red;"></p>
          </div>
        </div>
        <button class="place-order-btn" name="place_order" type="submit">PLACE ORDER</button>
        <div class="security-note">
          🔒 Your personal and payment information is securely transmitted via 128-bit encryption.
        </div>
      </div>
    </div>
  </form>
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
  const applyPromoBtn = document.getElementById('apply-promo');
  const promoInput = document.getElementById('promo');
  const promoMessage = document.getElementById('promo-message');
  const totalAmountDiv = document.getElementById('total-amount');
  const cardDetails = document.getElementById('card-details');

  const radios = document.querySelectorAll('input[name="payment_method"]');
  radios.forEach(radio => {
    radio.addEventListener('change', function () {
      cardDetails.style.display = (this.value === 'card') ? 'block' : 'none';
    });
  });

  let total = <?php echo json_encode($total); ?>;
  let discountPercent = 0;

  applyPromoBtn?.addEventListener('click', () => {
    const code = promoInput.value.trim();
    if (!code) {
      promoMessage.textContent = 'Please enter a promo code.';
      discountPercent = 0;
      updateTotal();
      return;
    }

    discountPercent = 10;
    promoMessage.style.color = 'green';
    promoMessage.textContent = `Promo code applied! You get ${discountPercent}% off.`;
    updateTotal();
  });

  function updateTotal() {
    if (discountPercent > 0) {
      const discounted = total * (1 - discountPercent / 100);
      totalAmountDiv.innerHTML = `<strong>Total Incl. VAT: AED ${discounted.toFixed(2)} (Discounted)</strong>`;
    } else {
      totalAmountDiv.innerHTML = `<strong>Total Incl. VAT: AED ${total.toFixed(2)}</strong>`;
      promoMessage.textContent = '';
    }
  }
</script>

</body>
</html>