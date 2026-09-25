<?php

// <-- Form to add a new program
// Add Program Form

include('data.php');
include('functions.php');

$msg = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(validateProgram($_POST)) {
        addProgram($programs, $_POST);
        $msg = "Program added successfully!";
    } else {
        $msg = "Please fill all fields correctly.";
    }
}

?>

<form method = "POST">
    <h2>Add New Program</h2>
    Name: <input name = "name"><br>
    Description: <textarea name = "description"></textarea><br>
    Coach: <input name = "coach"><br>
    Contact: <input name = "contact"><br>
    Duration (weeks): <input name = "duration" type = "number"><br>
    Skill Level: <select name = "skill_level">
                 <option>Beginner</option>
                 <option>Intermediate</option>
                 <option>Advanced</option>
                 </select><br>
                 <input type = "submit" value = "Add Program">
</form>
<p><?= $msg ?></p>