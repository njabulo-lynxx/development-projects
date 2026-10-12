<?php
include_once 'header.php';

// Initialize the variables (optional, but good practice)
$id = null;
$product_name = null;
$price = null;
$category = null;
$subcategory = null;
$quantity = null;
$details = null;

// check to see the url variable is set and that it exists in database
if (isset($_GET['id'])) {
    // Sanitize the input for safety
    $id = preg_replace('#[^0-9]#i', '', $_GET['id']);
    
    // Check to see if ID exists and output message if it doesn't exist
    // Use a prepared statement with a placeholder (?) for secure querying
    $stmt = $pdo->prepare("SELECT product_id, product_name, price, category, subcategory, quantity, details 
                           FROM products WHERE product_id = ? LIMIT 1");
    // Bind the sanitized ID to the placeholder and execute
    $stmt->execute([$id]);
    
    // Fetch the product details once
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a product was found
    if ($product) {
        // Assign the fetched data to local variables
        $id = $product["product_id"];
        $product_name = $product["product_name"];
        $price = $product["price"];
        $category = $product["category"];
        $subcategory = $product["subcategory"];
        $quantity = $product["quantity"];
        $details = $product["details"];
    } else {
        // If no product found
        echo "Item does not exist.";
        exit();
    }
} else {
    // If no ID provided in the URL
    echo "Data to render this page is missing.";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style/style.css" type="text/css" media="screen">
        <title><?php echo htmlspecialchars($product_name); ?></title>
    </head>
    <body>
        <div align="center">
            <div id="pageContent">
                <table width="100%" border="0" cellspacing="0" cellpadding="10">
                <tr>
                    <!-- It's good practice to use htmlspecialchars() when outputting dynamic data to prevent XSS -->
                    <td width= "20%" valign="top">
                        <img src="inventory_images/<?php echo htmlspecialchars($id); ?>.jpg" width="140" height="190" alt="<?php echo htmlspecialchars($product_name); ?>" />
                        <a href="inventory_images/<?php echo htmlspecialchars($id); ?>.jpg">View Full Size Image</a></td>
                    <td width="80%" valign="top">
                    <h3><?php echo htmlspecialchars($product_name); ?></h3>
                    <p>
                        <?php echo "R" . htmlspecialchars($price); ?><br><br />
                        <?php echo htmlspecialchars($subcategory) . " , " . htmlspecialchars($category); ?><br /><br />
                        <?php echo htmlspecialchars($details); ?><br />
                    </p>
                    <form id="form1" name="form1" method="post" action="cart.php">
                        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>"/>
                        <input type="submit" name="button" id="button" value="Add to Shopping Cart"/>
                    </form>
                </tr>
                </table>
            </div>
        </div>
    </body>
</html>