<?php
include 'php/db.php';

$category = 'Fruits'; // Replace this with dynamic input if needed

$stmt = $pdo->prepare("SELECT * FROM products WHERE category = ?");
$stmt->execute([$category]);
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo htmlspecialchars($category); ?> - ABC Retail Supermarket</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f8f8;
    }

    header {
      background-color: #244126;
      color: white;
      padding: 1.5rem 2rem;
      text-align: center;
    }

    h1 {
      font-size: 2rem;
      margin: 0;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
      padding: 2rem;
      max-width: 1600px;
      margin: 0 auto;
    }

    .product-card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 1rem;
      display: flex;
      flex-direction: column;
      transition: transform 0.2s;
    }

    .product-card:hover {
      transform: translateY(-5px);
    }

    .product-card img {
      width: 100%;
      aspect-ratio: 1 / 1;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 1rem;
    }

    .product-card h3 {
      font-size: 1.1rem;
      margin: 0.5rem 0;
      color: #244126;
    }

    .product-card p {
      margin: 0.25rem 0;
      font-size: 0.95rem;
    }

    .product-card .price {
      font-weight: bold;
      color: #86a47f;
    }
  </style>
</head>
<body>
  <header>
    <h1><?php echo htmlspecialchars($category); ?> Products</h1>
  </header>

  <main class="product-grid">
    <?php foreach ($products as $product): ?>
      <div class="product-card">
        <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
        <p class="price">AED <?php echo number_format($product['price'], 2); ?></p>
      </div>
    <?php endforeach; ?>
  </main>
</body>
</html>
