<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEADERBOARD</title>
</head>
<header>
        <h1>Leaderboard</h1>
    </header>
<body>
    <form method="post" action="">
            <input type="submit" name="exit" value="Dashboard">
    </form>
</body>
</html>

<?php
require_once("dbconn.php");
require_once("viewScores.php");

     if(isset($_POST['exit'])) {
         header('Location: Dashboard.php');
     }

     //View values from the leaderboard table
		show_scores($pdo);

?>