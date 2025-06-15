<?php
include 'php/db.php';
include 'php/functions.php';
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

    main .hero {
      padding: 2rem 1rem 3rem;
      text-align: center;
      color: #244126;
      font-weight: 600;
    }

    main .hero h2 {
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
    }

    main .hero p {
      font-size: 1.25rem;
    }

    .carousel {
      position: relative;
      overflow: hidden;
      max-width: 100%;
      height: 400px;
      margin: 2rem auto 1rem;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
      background-color: #f5f5f5;
    }

    .carousel-inner {
      position: relative;
      width: 100%;
      height: 100%;
    }

    .slide {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: none;
    }

    .slide.active {
      display: block;
    }

    .slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 10px;
      display: block;
    }

    .categories {
      margin: 2rem 0 4rem;
      width: 100%;
    }

    .category-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 2rem;
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
    }

    .category-card {
      width: 100%;
      aspect-ratio: 1 / 1;
      border-radius: 12px;
      overflow: hidden;
      text-decoration: none;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      background: none;
    }

    .category-card:hover {
      transform: scale(1.03);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .category-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 12px;
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

<main>
  <section class="carousel container">
    <div class="carousel-inner" id="carousel-inner">
      <div class="slide active"><img src="images/carousel1.jpg" alt="Fresh Vegetables" /></div>
      <div class="slide"><img src="images/carousel2.jpg" alt="Fresh Fruits" /></div>
      <div class="slide"><img src="images/carousel3.jpg" alt="Dairy Products" /></div>
      <div class="slide"><img src="images/carousel4.jpg" alt="Bakery Items" /></div>
      <div class="slide"><img src="images/carousel5.jpg" alt="Household Essentials" /></div>
    </div>
  </section>

  <section class="hero container">
    <h2>Fresh and Quality Groceries Delivered to Your Doorstep</h2>
    <p>Serving the MEA region with the finest products every day.</p>
  </section>

  <section class="categories">
    <div class="container">
      <div class="category-grid">
        <a href="category.php?id=1" class="category-card"><img src="images/categories/all.jpg" alt="All Products" /></a>
        <a href="category.php?id=2" class="category-card"><img src="images/categories/fruits.jpg" alt="Fruits" /></a>
        <a href="category.php?id=3" class="category-card"><img src="images/categories/vegetables.jpg" alt="Vegetables" /></a>
        <a href="category.php?id=4" class="category-card"><img src="images/categories/dairy.jpg" alt="Dairy" /></a>
        <a href="category.php?id=5" class="category-card"><img src="images/categories/bakery.jpg" alt="Bakery" /></a>
        <a href="category.php?id=6" class="category-card"><img src="images/categories/butchery.jpg" alt="Butchery" /></a>
        <a href="category.php?id=7" class="category-card"><img src="images/categories/fishery.jpg" alt="Fishery" /></a>
        <a href="category.php?id=8" class="category-card"><img src="images/categories/household.jpg" alt="Household" /></a>
        <a href="category.php?id=9" class="category-card"><img src="images/categories/frozen.jpg" alt="Frozen" /></a>
        <a href="category.php?id=10" class="category-card"><img src="images/categories/beverages.jpg" alt="Beverages" /></a>
      </div>
    </div>
  </section>
</main>

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

<script>
  (function () {
    const slides = document.querySelectorAll('.slide');
    let currentIndex = 0;

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
      });
      currentIndex = index;
    }

    function nextSlide() {
      const nextIndex = (currentIndex + 1) % slides.length;
      showSlide(nextIndex);
    }

    setInterval(nextSlide, 4000);
  })();
</script>
</body>
</html>