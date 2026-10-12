<?php
// inventory_list.php
include_once 'header.php';
require_once 'storescripts/dbconn.php';

// Count the products
$stmt_count = $pdo->prepare('SELECT COUNT(*) AS product_count FROM products');
$stmt_count->execute();
$result_count = $stmt_count->fetch(PDO::FETCH_ASSOC);
$product_count = $result_count['product_count'];

echo 'Total products: ' . $product_count . '<br>';

// Fetch and loop through products (if any)
if ($product_count > 0) {
    $stmt_products = $pdo->prepare('SELECT product_id, product_name, price FROM products');
    $stmt_products->execute();

    echo '<h2>Product List:</h2>';
    echo '<ul>';
    while ($row = $stmt_products->fetch(PDO::FETCH_ASSOC)) {
        echo '<li>';
        echo 'ID: ' . htmlspecialchars($row['product_id']) . ', ';
        echo 'Name: ' . htmlspecialchars($row['product_name']) . ', ';
        echo 'Price: R ' . htmlspecialchars($row['price']) . ' ';

        // Add Update button (link to update script)
        // Pass the product_id as a URL parameter
        echo '<a class="button" href="update_product.php?id=' . htmlspecialchars($row['product_id']) . '">Update</a> ';

        // Add Delete button (form to submit delete request)
        echo '<form method="POST" action="delete_product.php" style="display:inline;">';
        echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row['product_id']) . '">';
        // Use JavaScript for confirmation before deletion
        echo '<button type="submit" onclick="return confirm(\'Are you sure you want to delete this product?\')">Delete</button>';
        echo '</form>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo 'No products found in the database.';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
</head>
<body>
    <div>
        <a class="button" href="create_product.php">+ Add products</a>
    </div>
</body>
</html>
