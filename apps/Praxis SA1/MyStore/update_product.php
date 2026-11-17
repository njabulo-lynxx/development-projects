<?php
require_once "header.php";
require_once 'storescripts/dbconn.php';

// Handle the update submission
if (isset($_POST['update_button'])) {
    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT); 

    if ($product_id) {
        $product_name = htmlentities($_POST['product_name'] ?? '');
        $price = htmlentities($_POST['price'] ?? '');
        $category = htmlentities($_POST['category'] ?? '');
        $subcategory = htmlentities($_POST['subcategory'] ?? '');
        $details = htmlentities($_POST['details'] ?? '');
        $quantity = htmlentities($_POST['quantity'] ?? '');

        // Update the query to use 'product_id' column name
        $stmt = $pdo->prepare("UPDATE products SET product_name = :product_name, price = :price, category = :category, subcategory = :subcategory, details = :details, quantity = :quantity 
                               WHERE product_id = :product_id");
        // Bind the correct parameter name
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':subcategory', $subcategory);
        $stmt->bindParam(':details', $details);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':product_id', $product_id); 
        $stmt->execute();

        // Handle image update if a new file is uploaded
        if (isset($_FILES['fileField']) && $_FILES['fileField']['error'] == UPLOAD_ERR_OK) {
            $newname = "$product_id.jpg"; // Use product_id
            move_uploaded_file($_FILES['fileField']['tmp_name'], "inventory_images/$newname");
        }

        header("location: inventory_list.php?status=updated");
        exit();
    }
}

// Fetch product data to populate the form
$product_id_from_get = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$product_id_from_get) {
    header("location: inventory_list.php"); // Redirect if no valid ID is provided
    exit();
}

// Update query to use 'product_id'
$stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = :product_id"); 
$stmt->bindParam(':product_id', $product_id_from_get); // Bind the GET id to product_id
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found.";
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
</head>
<body>
    <h2>Update Product: <?php echo htmlspecialchars($product['product_name']); ?></h2>
    <form action="update_product.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>"> 
        <table width="90%" border="1" cellspacing="0" cellpadding="6">
            <tr>
                <td>Product Name</td>
                <td><input type="text" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>"></td>
            </tr>
            <tr>
                <td>Product Price</td>
                <td><input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>"
                        min="1"></td>
            </tr>
            <tr>
                <td>Category</td>
                <td><label><select name="category" id="category">
                <option value=""></option>
                <option value="Electronics">Electronics</option>
                <option value="Appliances">Appliances</select>
                </label></td>
            </tr>
            <tr>
                <td>Subcategory</td>
                <td><label><select name="subcategory" id="subcategory">
                <option value=""></option>
                <option value="Communication">Communication</option>
                <option value="Entertainment">Entertainment</select>
                </label></td>
            </tr>
            <tr>
                <td>Product Details</td>
                <td><textarea name="details" cols="64" rows="5"><?php echo htmlspecialchars($product['details']); ?></textarea></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><label><input type="number" name="quantity" id="quantity" size="5"
                value="<?php echo htmlspecialchars($product['quantity']); ?>" min="1">
                </label></td>
            </tr>
            <tr>
                <td>Product Image</td>
                <td><input type="file" name="fileField"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="update_button" value="Update Product"></td>
            </tr>
        </table>
    </form>
</body>
</html>