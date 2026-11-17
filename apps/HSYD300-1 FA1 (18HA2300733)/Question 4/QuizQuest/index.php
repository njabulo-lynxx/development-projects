<?php
    if(isset($_POST['start'])) {
        header('Location: Dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Quest</title>
</head>
    <header>
        <h1>Welcome to Quiz Quest</h1>
        <h1>The Ultimate Trivia Challenge!</h1>
        <h3>Do you have the courage to venture into the unknown?</h3>
    </header>
<body>
    <form method="post"> 
       <pre>
                  <input type="submit" name="start" value="YEAH!" size="10">
       </pre>
    </form>
</body>
</html>