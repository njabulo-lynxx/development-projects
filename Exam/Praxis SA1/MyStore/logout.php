<?php
require_once 'header.php';

// When the log out option is selected
// The current user logs out and is redirected to the guest home page

if (isset($_SESSION['admin']) || isset($_SESSION['customer'])) {
    destroySession();
    header('Location: index.php');
} 

?>