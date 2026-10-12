<?php
// Majority of the files will use this file.
// This means they will have easy access tothe database connection
// and session management
require_once 'storescripts/dbconn.php';
include_once 'functions/error_reporting.php';

// Start the session and include database connection
session_start();

// Initialize user string
$userstr = 'Welcome Guest';

// Check if admin or customer is logged in
if(isset($_SESSION['admin'])) {
    $admin_html_entities = htmlentities($_SESSION['admin']);
    $loggedin = TRUE;
    $userstr = "Admin $admin_html_entities has successfully logged in";
} elseif(isset($_SESSION['customer'])) {
    $customer_html_entities = htmlentities($_SESSION['customer']);
    $loggedin = TRUE;
    $userstr = "Customer $customer_html_entities logged in";
} else
    $loggedin = FALSE;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <script src="javascript.js"></script>
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- bootstrap css and js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    
</head>
<body>
    <div class="header">
        <div class="username"><?php echo $userstr; ?></div>
    <div class="content">

<!-- Admin Page -->
<?php
     if($loggedin && isset($_SESSION['admin'])) {
?>
    <div>
        <a class="button"
            href="home.php?view=<?php echo $admin_html_entities; ?>">
            <i class="bi-house-door-fill"></i> Home</a>
        <a class="button" 
            href="inventory_list.php">
            <i class="bi-backpack2"></i> Product Management</a>
        <a class="button" 
            href="logout.php">
            <i class="bi-door-closed-fill"></i> Log out</a>
    </div>

<!-- Customer Page -->
<?php
     } elseif($loggedin && isset($_SESSION['customer'])) {
?>
    <div>
        <a class="button" 
            href="home.php?view=<?php echo $customer_html_entities; ?>">
            <i class="bi-house-door-fill"></i> Home</a>
        <a class="button" 
            href="store.php">
            <i class="bi-bag-plus-fill"></i> Store</a>
        <a class="button" 
            href="cart.php">
            <i class="bi-cart4"></i> Cart</a>
        <a class="button" 
            href="checkout.php">
            <i class="bi-basket-fill"></i> Checkout</a>
        <a class="button" 
            href="logout.php">
            <i class="bi-door-closed-fill"></i> Log out</a>
    </div>

<!-- Guest Page -->
<?php
     } else {
?>    
    <div>
        <a class="button" 
            href="index.php">
            <i class="bi-house-door-fill"></i> Home</a>
        <a class="button" 
            href="register_customer.php">
            <i class="bi-box-arrow-in-right"></i> Register</a>
        <a class="button" 
            href="login.php">
            <i class="bi-arrow-up-square-fill"></i> Log In</a>
    </div>
     
<?php
     }
?>
    </body>
</html>