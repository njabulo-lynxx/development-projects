<?php
require_once 'header.php';

if (isset($_SESSION['admin'])) {
    destroySession();
    header('Location: index.php');
} else
    echo "<div class='center'>
          You cannot log out because you are not logged in</div>";

if (isset($_SESSION['student'])) {
    destroySession();
    header('Location: index.php');
} else
    echo "<div class='center'>
          You cannot log out because you are not logged in</div>";
?>