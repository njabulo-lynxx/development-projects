<?php
require_once 'header.php';

// if the user attempts to add something to the cart from the product page
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    $wasFound = false;
    $index = 0;

    // If the cart session variable is not set or cart array is empty
    if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
        // Run this code if the cart is empty or not set
        $_SESSION["cart_array"] = array(0 => array("item_id" => $pid, "quantity" => 1));
    } else {
        // Run this if the cart has atleast 1 item in it
        foreach ($_SESSION["cart_array"] as $each_item) {
            if ($each_item['item_id'] == $pid) {
                // That item is in the cart already so let's adjust its quantity
                $_SESSION["cart_array"][$index]['quantity'] += 1;
                $wasFound = true;
                break; // Exit loop once item is found and updated
            }
            $index++;
        }
        if ($wasFound == false) {
            // Push new item into the array
            array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" => 1));
        }
    }
    // After processing the POST data, redirect the user to prevent re-submission on refresh
    session_write_close(); // Save session data before redirection
    header("Location: cart.php");
    exit(); // Terminate script execution after redirection
}

// If user chooses to empty their shopping cart
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
    unset($_SESSION["cart_array"]);
    session_write_close();
    header("Location: cart.php");
    exit();
}

// If user chooses to adjust item quantity
if (isset($_POST['item_to_update']) && $_POST['item_to_update'] != "") {
    $item_to_update = $_POST['item_to_update'];
    $quantity = $_POST['quantity'];
    // Validate quantity
    if ($quantity < 1) {
        // Remove item if quantity is 0 or less
        foreach ($_SESSION["cart_array"] as $key => $each_item) {
            if ($each_item['item_id'] == $item_to_update) {
                unset($_SESSION["cart_array"][$key]);
                sort($_SESSION["cart_array"]); // Re-sort array keys
                break;
            }
        }
    } else {
        foreach ($_SESSION["cart_array"] as $key => $each_item) {
            if ($each_item['item_id'] == $item_to_update) {
                // Update the quantity in the session array
                $_SESSION["cart_array"][$key]['quantity'] = $quantity;
                break;
            }
        }
    }
    session_write_close();
    header("Location: cart.php");
    exit();
}

// if the user wants to remove an item from the cart
if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
    // Access the array and run code to remove that array index
    $key_to_remove = $_POST['index_to_remove'];
    if (count($_SESSION["cart_array"]) <= 1) {
        unset($_SESSION["cart_array"]);
    } else {
        unset($_SESSION["cart_array"][$key_to_remove]);
        sort($_SESSION["cart_array"]); // Re-sort array keys after removal
    }
    session_write_close();
    header("Location: cart.php");
    exit();
}


//####################### Render the cart for the user to view ###########################
$cartOutput = "";
$cartTotal = 0;

if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
} else {
    // Use the actual array key as the index for removal
    foreach ($_SESSION["cart_array"] as $key => $each_item) {
        // Cart array items get assigned to the $item_id variable to use for mySQL queries
        $item_id = $each_item['item_id'];
        
        // Use a prepared statement with a placeholder (?) for secure querying
        $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = ? LIMIT 1");
        $stmt->execute([$item_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) { // Check if a product was found
            $product_name = $row['product_name'];
            $price = $row['price'];
            $details = $row['details'];
        } else {
            continue; // Skip this item
        }

        // Increase the price when more quantities of a product get added
        $itemPriceTotal = $price * $each_item['quantity']; // Temporary variable for single item total
        $cartTotal += $itemPriceTotal; // Total of all items in the cart

        // Create a new NumberFormatter instance for South African currency
        $num_format = new NumberFormatter('en_ZA', NumberFormatter::CURRENCY);

        // Dynamic Table row assembly
        $cartOutput .= "<tr>";
        $cartOutput .= '<td><a href="product.php?id=' . htmlspecialchars($item_id) . '">' . htmlspecialchars($product_name) . '</a>' . '<br />
                        <img src="inventory_images/' . htmlspecialchars($item_id) . '.jpg" 
                        alt="' . htmlspecialchars($product_name) . '" width="40" height="50" border="1"/>
                        </td>';
        $cartOutput .= '<td>' . htmlspecialchars($details) . '</td>';
        $cartOutput .= '<td>' . htmlspecialchars($num_format->format($price)) . '</td>';
        $cartOutput .= '<td><form action="cart.php" method="post">
                        <input name="quantity" type="number" value="' . htmlspecialchars($each_item['quantity']) . '" 
                        size="1" maxlength="2" min="1" max="10" /><input type="submit" value="update"/>
                        <input name="item_to_update" type="hidden" value="' . htmlspecialchars($item_id) . '">
                        </form></td>';
        $cartOutput .= '<td>' . htmlspecialchars($num_format->format($itemPriceTotal)) . '</td>';
        // Form for removal. Use the actual array key ($key) here.
        $cartOutput .= '<td><form action="cart.php" method="post"><input type="submit" value="remove"/>
                        <input name="index_to_remove" type="hidden" value="' . htmlspecialchars($key) . '">
                        </form></td>';
        $cartOutput .= '</tr>';
    }

    // Format the final $cartTotal variable outside the loop
    $cartTotal = "<b>TOTAL:</b><br>" . $num_format->format($cartTotal);
}

//####################### END of Render the cart for the user to view ###########################

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your Cart</title>
</head>
<body>
    <div align="center">
        <div class="border">
            <div style="margin: 24px; text-align: left;">
                <table width="100%" border="1" cellspacing="0" cellpadding="10">
                    <tr>
                        <td width="25%">Name</td>
                        <td width="40%">Product Description</td>
                        <td width="10%">Unit Price</td>
                        <td width="5%">Quantity</td>
                        <td width="10%">Total</td>
                        <td width="10%">Remove</td>
                    </tr>
                        <?php echo $cartOutput; ?>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td><?php echo $cartTotal; ?></td>
                        <!-- Form to proceed to checkout -->
                        <td>
                            <form action="checkout.php" method="post">
                                <button type='submit' name='proceed_to_checkout'>Proceed to Checkout</button>
                            </form>
                        </td>
                    </tr>
                </table>
                <br /><br />
                <a href="cart.php?cmd=emptycart">Click Here to Empty Your Shopping Cart</a>
            </div>
        <br />
        </div>
    </div>
</body>
</html>