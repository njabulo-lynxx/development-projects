<?php
require_once 'header.php';

// Ensure the user has items in the cart before proceeding to checkout
if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    echo "<h2>Your cart is empty.</h2>";
    echo "<p><a href='store.php'>Continue Shopping</a></p>";
    exit();
}

$cartOutput = "";
$cartTotal = 0;
$index = 0;

// Gather all product IDs from the session array to query the database efficiently
$productIds = array_column($_SESSION["cart_array"], 'item_id');
$idList = implode(',', array_fill(0, count($productIds), '?'));

try {
    // Prepare a dynamic SQL query using IN clause
    $stmt = $pdo->prepare("SELECT product_id, product_name, price FROM products WHERE product_id IN ($idList)");
    $stmt->execute($productIds);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Map products by their ID for easy lookup
    $productMap = array_column($products, null, 'product_id');

    // Create a new NumberFormatter instance for South African currency
    $num_format = new NumberFormatter('en_ZA', NumberFormatter::CURRENCY);

    foreach ($_SESSION["cart_array"] as $each_item) {
        $itemId = $each_item['item_id'];

        if (isset($productMap[$itemId])) {
            $productDetails = $productMap[$itemId];
            $productName = htmlspecialchars($productDetails['product_name']);
            $price = htmlspecialchars($productDetails['price']);
            $quantity = htmlspecialchars($each_item['quantity']);

            $sn = $index + 1;
            $itemPriceTotal = $price * $quantity;
            $cartTotal = $itemPriceTotal + $cartTotal;

            $cartOutput .= '<tr>';
            $cartOutput .= '<td>' . $sn . '</td>';
            $cartOutput .= '<td>' . $productName . '</td>';
            $cartOutput .= '<td>' . htmlspecialchars($num_format->format($price)) . '</td>';
            $cartOutput .= '<td>' . $quantity . '</td>';
            $cartOutput .= '<td>' . htmlspecialchars($num_format->format($itemPriceTotal)) . '</td>';
            $cartOutput .= '</tr>';
            $index++;
        }
    }
    // Format total for display
    $cartTotalDisplay = sprintf("%.2f", $cartTotal);

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit();
}

// Handle the 'buy' action if the user clicks the button
if (isset($_POST['action']) && $_POST['action'] == 'buy') {

    echo "<h2>Thank You For Your Purchase!</h2>";
    echo "<p>Your order for a total of R$cartTotalDisplay has been placed.</p>";

    unset($_SESSION["cart_array"]); // Clear the cart after successful "purchase"
    session_write_close(); // Save session data
    exit(); // Stop further rendering of the checkout page
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <div align="center">
        <div class="border">
            <div style="margin: 24px; text-align: left;">
                <h2>Checkout Summary</h2>
                <table border="1" cellpadding="5" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Item Number</th>
                            <th>Product Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $cartOutput; ?>
                    </tbody>
                </table>
                <br />
                <h3>Cart Total: R<?php echo $cartTotalDisplay; ?></h3>
                <form method="post" action="checkout.php">
                    <input type="hidden" name="action" value="buy">
                    <button type="submit">Complete Purchase</button>
                </form>
                <p><a href="cart.php">Go back to Cart</a> | 
                   <a href="store.php">Continue Shopping</a></p>                
            </div>
        </div>
    </div>
</body>
</html>