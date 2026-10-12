<?php
// This displays a welcome message to the user's.
require_once 'header.php';

// Checks the current user and displays the appropriate welcome message
if($loggedin && isset($_SESSION['admin'])) {
    $admin_html_entities = htmlentities($_SESSION['admin']);
    echo "<div class='border'>
            <h1><b>Welcome Admin $admin_html_entities to the store<b></h1>
            <h2>Please manage the store wisely</h2>
          </div>";

} elseif($loggedin && isset($_SESSION['customer'])) {
    $student_html_entities = htmlentities($_SESSION['customer']);
    echo "<div class='border'>
            <h1>Welcome $student_html_entities to the store</h1>
            <h2>Happy shopping!</h2>
          </div>";
} 
?>