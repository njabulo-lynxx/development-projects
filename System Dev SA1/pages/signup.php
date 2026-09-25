<?php
// Student Sign Up Page

// Include header
require_once 'header.php';

// Initialize variables
$error = $student = "";

// Destroy any existing session
if (isset($_SESSION['student']))
    destroySession();

// Process form submission
if (isset($_POST['student'])) {
    $student = $_POST['student'];
    if ($_POST['student'] === "" || $_POST['pass'] === "")
        $error = 'Not all fields were entered';
    else {
        $stmt = $pdo->prepare('SELECT * FROM studentauth WHERE student = ?');
        $stmt->execute([$student]);
        if ($stmt->rowCount())
            $error = 'That username already exists<br><br>';
        else {
            $stmt = $pdo->prepare('INSERT INTO studentauth VALUES(?, ?)');
            $stmt->execute([$student, password_hash($_POST['pass'], PASSWORD_DEFAULT)]);
            die('<h4>Account created</h4>Please Log in.</div></body></html>');
        }
    }
}

// Escape output for HTML
$error_html_entities = htmlentities($error);
$student_html_entities = htmlentities($student);
?>

<form method="post" action="studSU.php">
    <div>
        <p class="error">
            <?php echo $error_html_entities; ?>
        </p>
    </div>

    <div>
        <h2>Create a student account</h2>
        <p>This account will be used by the student at the login home page</p>
        <p>Tips:<br>
           # Username should be student's full name<br>
           # Password should be student ID</p>
    </div>

    <div>
        <p>
            <label>Username</label>
            <input type="text" maxlength="16" name="student" id="username"
             value="<?php echo $student_html_entities; ?>">
            <label></label><span id="used">&nbsp;</span> 
        </p>
    </div>

    <div>
        <p>
            <label>Password</label>
            <input type="text" name="pass">
        </p>
    </div>

    <div>
        <p>
            <label></label>
            <input type="submit" values="Sign Up">
        </p>
    </div>

    </form>
    <script>
        const field = byId('username');
        field.onblur = () => {
            if (field.value === '')
                return
            const data = new FormData()
            data.set('student', field.value)
            fetch('verifyuser.php', { method: 'post', body: data})
                 .then(response => response.text())
                 .then(text => byId('used').innerHTML = text)
        }
    </script>
   </div>
 </body>    
</html>