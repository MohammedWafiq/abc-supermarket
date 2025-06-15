<?php
include 'php/db.php';
include 'php/functions.php';

$category_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT category_name, banner_image FROM categories WHERE id = ?");
$stmt->execute([$category_id]);
$category = $stmt->fetch();

if (!$category) {
    echo "Category not found.";
    exit;
}

$category_name = $category['category_name'];
$banner_image = $category['banner_image'];

// Fetch products by category name
// Fetch all products if category is "All Products"
if (strtolower($category_name) === 'all products') {
    $productStmt = $pdo->query("SELECT * FROM products");
    $products = $productStmt->fetchAll();
} else {
    // Fetch products by category name
    $productStmt = $pdo->prepare("SELECT * FROM products WHERE category = ?");
    $productStmt->execute([$category_name]);
    $products = $productStmt->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ABC Retail Supermarket | Home</title>
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

    body {
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 0;
      background-color:rgb(255, 255, 255);
    }

    .banner {
      width: 100%;
      height: auto;
    }

    .container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 0 1rem;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 2rem;
    }

    .product-card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      padding: 1rem;
      transition: transform 0.2s ease;
    }

    .product-card:hover {
      transform: translateY(-4px);
    }

    .product-card img {
      width: 100%;
      height: 200px;
      object-fit: contain;
      margin-bottom: 1rem;
    }

    .product-card h3 {
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: #244126;
    }

    .product-card .price {
      font-weight: 700;
      color: #86a47f;
      margin-bottom: 1rem;
    }

    .product-card form {
      display: flex;
      gap: 0.5rem;
    }

    .product-card form button {
      flex: 1;
      background-color: #244126;
      color: #fff;
      border: none;
      padding: 0.5rem;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.3s;
    }

    .product-card form button:hover {
      background-color: #86a47f;
      color: #244126;
    }

.banner-wrapper {
  display: flex;
  justify-content: center;
  margin: 2rem auto 1rem auto;
}

.banner {
  width: 100%;
  max-width: 1200px; /* max width when screen is wide enough */
  height: auto;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
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


<div class="banner-wrapper">
  <img class="banner" src="images/<?php echo htmlspecialchars($banner_image); ?>" alt="Category Banner" />
</div>

<div class="container">
  <div class="product-grid">
    <?php foreach ($products as $product): ?>
      <div class="product-card">
        <a href="product.php?id=<?php echo $product['id']; ?>">
          <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
          <h3><?php echo htmlspecialchars($product['name']); ?></h3>
        </a>
        <div class="price">AED <?php echo number_format($product['price'], 2); ?></div>

        <form class="add-to-cart-form">
          <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
          <button type="submit" name="add_to_cart">
            <i class="fas fa-shopping-cart"></i> Add to Cart
          </button>
        </form>

        <!-- Wishlist form moved INSIDE the loop -->
        <form method="post" action="wishlist.php" style="display: flex; margin-top: 0.5rem;">
          <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
          <button type="submit" name="add_to_wishlist">
            <i class="fas fa-heart"></i> Add to Wishlist
          </button>
        </form>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div id="toast" style="display: none; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background-color: #28a745; color: white; padding: 12px 24px; border-radius: 6px; z-index: 9999; font-weight: bold;">
  Item added to cart
</div>

<script>
document.querySelectorAll('.add-to-cart-form').forEach(form => {
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(form);

    fetch('php/cart.php', {
      method: 'POST',
      body: formData
    }).then(response => {
      if (response.ok) {
        const toast = document.getElementById('toast');
        toast.style.display = 'block';
        setTimeout(() => {
          toast.style.display = 'none';
        }, 2000);
      } else {
        alert('Something went wrong.');
      }
    });
  });
});
</script>
<script>
const searchInput = document.getElementById('search-input');
const resultsDiv = document.getElementById('search-results');

searchInput.addEventListener('input', () => {
  const query = searchInput.value.trim();

  if (query.length < 2) {
    resultsDiv.style.display = 'none';
    resultsDiv.innerHTML = '';
    return;
  }

  fetch('ajax_search.php?query=' + encodeURIComponent(query))
    .then(res => res.json())
    .then(data => {
      if (data.length === 0) {
        resultsDiv.style.display = 'none';
        resultsDiv.innerHTML = '';
        return;
      }

      resultsDiv.innerHTML = data.map(product => `
        <a href="product.php?id=${product.id}" style="
          display: flex; 
          align-items: center; 
          padding: 0.5rem 1rem; 
          border-bottom: 1px solid #eee; 
          text-decoration: none; 
          color: #333;
        ">
          <img src="images/${product.image}" alt="${product.name}" style="width: 40px; height: 40px; object-fit: contain; margin-right: 1rem;" />
          <span>${product.name}</span>
        </a>
      `).join('');

      resultsDiv.style.display = 'block';
    })
    .catch(() => {
      resultsDiv.style.display = 'none';
      resultsDiv.innerHTML = '';
    });
});

// Hide dropdown when clicking outside
document.addEventListener('click', e => {
  if (!searchInput.contains(e.target) && !resultsDiv.contains(e.target)) {
    resultsDiv.style.display = 'none';
  }
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
