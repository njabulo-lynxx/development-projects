<?php
// This is the home page for the Student Portal system.
// It displays a welcome message to the user.

// Include the header file to manage sessions and navigation
require_once 'header.php';

// Checks the current user and displays the appropriate welcome message
if($loggedin && isset($_SESSION['admin'])) {
    $admin_html_entities = htmlentities($_SESSION['admin']);
    echo "<div class='border'>
            <h1><b>Welcome Admin $admin_html_entities to the student portal<b></h1>
            <h2>Please manage your students wisely</h2>
            <h2>Tips:</h2>
            <h2><b>#Management</b> option is to register students and see the list of registered students.</h2>
            <h2>You can edit or delete created students and view or download the registration slip.</h2>
            <h2><b>#Student Profiles</b> option is used to view the profiles of the students.</h2>
            <h2>Profiles are set to read-only since they can be edited or deleted in <b>Management</b></h2>
            <h2><b>#Sign Up</b> option is when you decide to create an account for the student.</h2>
            <h2>I strongly recommend you use the student's full name as the username</h2>
          </div>";

} elseif($loggedin && isset($_SESSION['student'])) {
    $student_html_entities = htmlentities($_SESSION['student']);
    echo "<div class='border'>
            <h1>Welcome Student $student_html_entities to the student portal</h1>
            <h2>Please enjoy your stay</h2>
            <h2>Tips:</h2>
            <h2><b>#Student Profile</b> option is for you to see your profile.</h2>
            <h2>Note that you won't be able to edit anything for the time being.</h2>
            <h2><b>#Student Report</b> option has only two buttons, view and download.</h2>
            <h2>You can either view your profile in a pdf form or download it to your system.</h2>
          </div>";
} 
?>