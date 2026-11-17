<?php
require_once "header.php";

// Check if the form was submitted
if (isset($_POST['create_button'])) {
    // Get form data and sanitize it
    $product_name = htmlentities($_POST['product_name'] ?? '');
    $price = htmlentities($_POST['price'] ?? '');
    $category = htmlentities($_POST['category'] ?? '');
    $subcategory = htmlentities($_POST['subcategory'] ?? '');
    $quantity = htmlentities($_POST['quantity'] ?? '');
    $details = htmlentities($_POST['details'] ?? '');

    // Prepare and execute the INSERT statement
    $stmt = $pdo->prepare("INSERT INTO products(product_name, price, category, subcategory, quantity, details) 
                           VALUES(:product_name, :price, :category, :subcategory, :quantity, :details)");
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':subcategory', $subcategory);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':details', $details);
    $stmt->execute();

    // To know the the value of the product_id while using auto_increment
    $pid = $pdo->lastInsertId();

    // Place image in the folder
    $newname = "$pid.jpg";
    if (isset($_FILES['fileField']) && $_FILES['fileField']['error'] == UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES['fileField']['tmp_name'], "inventory_images/$newname");
    }

    // Redirect back to Manage Inventory Page to prevent form resubmission
    header("location: inventory_list.php?status=created");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
</head>
<body>
    <form action="create_product.php" enctype="multipart/form-data" name="myForm" id="myForm" method="post">
        <table width="90%" border="1" cellspacing="0" cellpadding="6">
        <tr>
            <td width="20%">Product Name</td>
            <td width="80%"><label>
                <input type="text" name="product_name" id="product_name" size="64" required>
                </label></td>
        </tr>
        <tr>
            <td>Product Price</td>
            <td><label>R <input type="number" name="price" id="price" size="12" min="1">
            </label></td>
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
            <td><label><textarea name="details" id="details" cols="64" rows="5"></textarea>
            </label></td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td><label><input type="number" name="quantity" id="quantity" size="5" min="1">
            </label></td>
        </tr>
        <tr>
            <td>Product Image</td>
            <td><label><input type="file" name="fileField" id="fileField">
            </label></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><label><input type="submit" name="create_button" id="button" value="Add this item">
            </label></td>
        </tr>
        </table>
    </form>
</body>
</html>
