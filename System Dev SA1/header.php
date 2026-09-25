<?php
// This is the header file for the Student Portal system.
// It manages user sessions and displays navigation options based on user roles.
// It supports three types of users: Admin, Student, and Guest.

// Start the session and include database connection
session_start();
require_once 'dbconn.php';

// Initialize user string
$userstr = 'Welcome Guest';

/*
$_SESSION['admin'] = '';
$_SESSION['student'] = '';
*/

// Check if admin or student is logged in
if(isset($_SESSION['admin'])) {
    $admin_html_entities = htmlentities($_SESSION['admin']);
    $loggedin = TRUE;
    $userstr = "Admin $admin_html_entities has successfully logged in";
} elseif(isset($_SESSION['student'])) {
    $student_html_entities = htmlentities($_SESSION['student']);
    $loggedin = TRUE;
    $userstr = "Student $student_html_entities logged in";
} else
    $loggedin = FALSE;

?>

<!-- HTML Header Section -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="javascript.js"></script>
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- bootstrap css and js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <title>Student Portal</title>
</head>
<body>
    <div class="header">
        <div class="username"><?php echo $userstr; ?></div>
    <div class="content">

<!-- Admin Page -->
<?php
     if($loggedin && isset($_SESSION['admin'])) {
?>
    <div class="center">
        <a class="button"
            href="home.php?view=<?php echo $admin_html_entities; ?>">
            <i class="bi-house-door-fill"></i> Home</a>
        <a class="button"
            href="management.php">
            <i class="bi-person-fill"></i> Management</a>
        <a class="button"
            href="Profile.php">
            <i class="bi-envelope-fill"></i> Student Profiles</a>
        <a class="button" 
            href="signup.php">
               <i class="bi-arrow-up-circle-fill"></i> Sign Up</a>
        <a class="button" 
            href="logout.php">
            <i class="bi-door-closed-fill"></i> Log out</a>
    </div>

<!-- Student Page -->
<?php
     } elseif($loggedin && isset($_SESSION['student'])) {
?>
    <div class="center">
        <a class="button" 
            href="home.php?view=<?php echo $student_html_entities; ?>">
            <i class="bi-house-door-fill"></i> Home</a>
        <a class="button" 
            href="studentProfile.php">
            <i class="bi-person-fill"></i> Student Profile</a>
        <a class="button" 
            href="studentReport.php">
            <i class="bi-heart-fill"></i> Student Report</a>
        <a class="button" 
            href="logout.php">
            <i class="bi-door-closed-fill"></i> Log out</a>
    </div>

<!-- Guest Page -->
<?php
     } else {
?>    
    <div class="center">
        <a class="button" 
            href="index.php">
            <i class="bi-house-door-fill"></i> Home</a>
        <a class="button" 
            href="login.php">
            <i class="bi-box-arrow-in-right"></i> Log In</a>
    </div>
     
<?php
     }
?>

    </body>
</html>