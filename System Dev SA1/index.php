<?php
require_once 'header.php';

echo "<div class='border'>Welcome to the System Dev SA1 Web App!";

if ($loggedin) {
    $admin_html_entities = htmlentities($_SESSION['admin']);
    echo " $admin_html_entities, you have successfully logged in";
} else
    echo '<br>Please sign up or log in';

if ($loggedin) {
    $student_html_entities = htmlentities($_SESSION['student']);
    echo " $student_html_entities, you have successfully logged in";
} else
    echo '<br>Please sign up or log in';

?>

    </div>
  </div>
  
</body>
</html>