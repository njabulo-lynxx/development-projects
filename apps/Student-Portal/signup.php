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
            $error = 'That username already exists';
        else {
            $stmt = $pdo->prepare('INSERT INTO studentauth VALUES(?, ?)');
            $stmt->execute([$student, password_hash($_POST['pass'], PASSWORD_DEFAULT)]);
            die('<h1>Student account has been created successfully!</h1>');
        }
    }
}

// Escape output for HTML
$error_html_entities = htmlentities($error);
$student_html_entities = htmlentities($student);
?>

<form method="post" action="signup.php">
    <div class="error">
        <?php echo $error_html_entities; ?> 
    </div>

    <div>
        <h1><b>Create a student account</b></h1>
        <p><strong>Note:<br>
           # Username should always be student's full name<br>
           I cannot disclose of the reason here as it might<br>
           have an impact of the security of the website</strong></p>
    </div>

    <div>
            <label>Username</label>
            <input type="text" maxlength="50" name="student" id="username"
             value="<?php echo $student_html_entities; ?>">
            <label></label><span id="used">&nbsp;</span> 
    </div>

    <div>
            <label>Password</label>
            <input type="text" maxlength="16" name="pass">
    </div>

    <div>
            <label></label>
            <input type="submit" value="Create">
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
 </body>    
</html>