<?php
// This is the home page for the Student Portal system.
// It displays a welcome message to the user.

// Include the header file to manage sessions and navigation
require_once 'header.php';

// Checks the current user and displays the appropriate welcome message
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <!-- Home page for logged in user -->   
    <div class='border'>
        <h1>Welcome to the student portal</h1>
        <h2>Please enjoy your stay</h2>
    </div>
</body>
</html>