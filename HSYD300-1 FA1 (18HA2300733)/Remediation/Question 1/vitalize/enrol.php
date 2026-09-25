<?php

// <-- Enrolment form
// Gymnast Enrolment

include('data.php');
include('functions.php');

$msg = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    enrolGymnast($enrolments, $_POST);
    $msg = "Enrolment successful. Coach has been notified.";
}

?>

<form method = "POST">
    <h2>Enrol Gymnast</h2>
    Program: 
    <select name = "program_id">
                <?php foreach($programs as $p): ?>
                <option value = "<?= $p['id'] ?>"><?= $p['name'] ?>
                (<?= $p['coach'] ?>)</option>
                <?php endforeach; ?>
    </select><br>
    Name: <input name = "name"><br>
    Age: <input name = "age" type = "number"><br>
    Experience Level: <input name = "experience"><br>
         <input type = "submit" value = "Enroll">
</form>
<p><?= $msg ?></p>