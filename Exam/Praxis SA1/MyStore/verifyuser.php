<?php
// This script verifies if a username is already taken in the database.
// It checks customer usernames based on the POST parameters received.
// It returns an HTML snippet indicating whether the username is available or taken.

require_once 'storescripts/dbconn.php';

$customer_html_entities = '';

// Check for customer username
if (isset($_POST['customer'])) {
    $stmt = $pdo->prepare('SELECT * FROM customers1 WHERE customer = ?');
    $stmt->execute([$_POST['customer']]);

    $customer_html_entities = htmlentities($_POST['customer']);
    if ($stmt->rowCount())
        echo "<span class='taken'>&nbsp; &#x2718; " .
             "The username '$customer_html_entities' is taken</span>";
    else
        echo "<span class='available'>&nbsp; &#x2714; " .
             "The username '$customer_html_entities' is available</span>";
}

?>