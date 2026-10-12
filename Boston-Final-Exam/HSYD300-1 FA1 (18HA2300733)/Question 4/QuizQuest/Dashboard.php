<?php

    if(isset($_POST['start_quiz'])) {
       header('Location: startquiz.php');
    }
    if(isset($_POST['create_questions'])) {
       header('Location: createquestions.php');
    }
    if(isset($_POST['manage_rounds'])) {
       header('Location: managerounds.php');
    }
    if(isset($_POST['delete_quiz'])) {
       header('Location: deletequizdata.php');
    }
    if(isset($_POST['leaderboard'])) {
       header('Location: leaderboard.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <form method="post" action="">
        <pre>
            <br>
            <input type="submit" name="start_quiz" value="START QUIZ">
            <br>
            <input type="submit" name="create_questions" value="CREATE QUESTIONS">
            <br>
            <input type="submit" name="manage_rounds" value="MANAGE ROUNDS">
            <br>
            <input type="submit" name="delete_quiz" value="DELETE QUIZ DATA">
            <br>
            <input type="submit" name="leaderboard" value="LEADERBOARD">
            <br>
        </pre>
    </form>
    
</body>
</html>