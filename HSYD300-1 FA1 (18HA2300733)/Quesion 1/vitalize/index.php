<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitalize</title>
</head>
    <header>
        <h1>Welcome to vitalize<h1>
    </header>
<body>
    <form method="post" action="">
        <pre>
            <input type="submit" name="button_1" value="Enrol Gymnast">

            <input type="submit" name="button_2" value="Gymnast Program">
        </pre>
    </form>
</body>
</html>

<?php

    if(isset($_POST['button_1'])) {
        header('Location: enrol.php');
    }

    if(isset($_POST['button_2'])) {
        header('Location: program.php');
    }

?>