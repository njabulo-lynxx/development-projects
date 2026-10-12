<?php
require_once "header.php";

// Change the input method from INPUT_GET to INPUT_POST
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

// Redirect if the product ID is missing or invalid
if (!$product_id) {
    header("location: inventory_list.php");
    exit();
}

try {
    // Prepare and execute the deletion query
    $stmt = $pdo->prepare("DELETE FROM products WHERE product_id = :product_id");
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();

    // Optional: Delete the associated image file
    $image_path = "inventory_images/$product_id.jpg";
    if (file_exists($image_path)) {
        unlink($image_path);
    }

    // Redirect back to the inventory list with a success status
    header("location: inventory_list.php?status=deleted");
    exit();
} catch (PDOException $e) {
    // Handle error (e.g., if other tables depend on this product ID)
    echo "Error deleting product: " . htmlspecialchars($e->getMessage());
    exit();
}
?>
