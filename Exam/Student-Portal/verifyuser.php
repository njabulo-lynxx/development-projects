<?php
// This script verifies if a username is already taken in the database.
// It checks both admin and student usernames based on the POST parameters received.
// It returns an HTML snippet indicating whether the username is available or taken.

require_once 'dbconn.php';

$student_html_entities = '';

// Check for student username
if (isset($_POST['student'])) {
    $stmt = $pdo->prepare('SELECT * FROM studentauth WHERE student = ?');
    $stmt->execute([$_POST['student']]);

    $student_html_entities = htmlentities($_POST['student']);
    if ($stmt->rowCount())
        echo "<span class='taken'>&nbsp; &#x2718; " .
             "The username '$student_html_entities' is taken</span>";
    else
        echo "<span class='available'>&nbsp; &#x2714; " .
             "The username '$student_html_entities' is available</span>";
}

?>