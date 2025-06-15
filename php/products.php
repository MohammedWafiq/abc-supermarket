<?php
include 'db.php';

function displayProducts() {
  global $pdo;
  $stmt = $pdo->query('SELECT id, name, price, image, description FROM products LIMIT 12');
  while ($product = $stmt->fetch()) {
    echo '<div class="product-card">';
    echo '<a href="product.php?id=' . htmlspecialchars($product['id']) . '">';
    echo '<img src="images/' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '">';
    echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
    echo '</a>';
    echo '<p class="price">AED ' . number_format($product['price'], 2) . '</p>';
    echo '<form method="post" action="php/cart.php">';
    echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($product['id']) . '">';
    echo '<button type="submit" name="add_to_cart">Add to Cart</button>';
    echo '</form>';
    echo '</div>';
  }
}
?>
