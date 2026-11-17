<?php

// <-- Track attendance & progress
// Track Attendance & Show Progress

include('data.php');
include('functions.php');

?>

<form method = "POST">
    Program ID: <input name = "program_id"><br>
    Gymnast Name: <input name = "gymnast"><br>
    Date: <input name = "session_date" type = "date"><br>
    Present? <input type = "checkbox" name = "present" value = "1"><br>
    <input type = "submit" value = "Mark Attendance">
</form>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    trackAttendance($attendance, $_POST['program_id'], $_POST['gymnast'],
                    $_POST['session_date'], isset($_POST['present']));
    echo "<p>Attendance recorded.</p>";
}

?>

<h3>Progress Lookup</h3>
<form method = "GET">
    Program ID: <input name = "pid"><br>
    Gymnast Name: <input name = "gname"><br>
    <input type = "submit" value = "Check Progress">
</form>

<?php

if(isset($_GET['pid']) && isset($_GET['gname'])) {
    $percent = calculateProgress($attendance, $_GET['pid'], $_GET['gname']);
    echo "<p>Progress for {$_GET['gname']}: " . round($percent) . "%</p>";
}

?>