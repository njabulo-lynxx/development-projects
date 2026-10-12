<?php
include_once 'header.php';
$dynamicList = '';

// Count the products
$stmt_count = $pdo->prepare('SELECT COUNT(*) AS product_count FROM products');
$stmt_count->execute();
$result_count = $stmt_count->fetch(PDO::FETCH_ASSOC);
$product_count = $result_count['product_count'];

// Run a select query to get my latest 3 items
// These are the items that show up. You can increase 
// or decrease them as you see fit
if ($product_count > 0) {
    $stmt_products = $pdo->prepare('SELECT * FROM products ORDER BY product_id DESC LIMIT 3');
    $stmt_products->execute();

    while ($row = $stmt_products->fetch(PDO::FETCH_ASSOC)) {
        // Initialize the variables
        $id = $row['product_id'];
        $product_name = $row['product_name'];
        $price = $row['price'];

        $dynamicList .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="20%">
                    <a href="product.php?id=' . $id . '">
                        <img style="border: #666 1px solid;" src="inventory_images/' . $id . '.jpg" 
                        alt="' . $product_name . '" width="80" height="100" border="1">
                    </a>
                </td>
                <td width="80%" valign="top">
                    ' . $product_name . '<br />
                    R' . $price . '<br />
                    <a href="product.php?id=' . $id . '">View Product Details</a>
                </td>
            </tr>
        </table>';
    }
} else {
    $dynamicList = 'No products found in the database.';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen">
    <title>Store Home Page</title>
</head>
<body>
    <div align="center" id="mainWrapper">
        <div class="border">
            <table width="100%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td width= "30%" valign="top">
                        <p>Some text about the website here...</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                    </td>
                    <td width="40%" valign="top">
                        <p>Newest Items Added to the store</p>
                        <p><?php echo $dynamicList; ?><br></p>
                    </td>
                    <td width="30%" valign="top">
                        <p>More text about the store here..</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>