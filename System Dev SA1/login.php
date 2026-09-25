<?php
// This is a combined login.php file for both students and admins
// It uses a dropdown to select user type and processes login accordingly.

// Assumes a database connection is established in header.php
require_once 'header.php';

$error = $username = "";

// Default to student login
$userType = isset($_POST['userType']) ? $_POST['userType'] : 'student';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    if ($username === "" || $_POST['pass'] === "")
        $error = 'Not all fields were entered';
    else {
        if ($userType === 'admin') {
            $stmt = $pdo->prepare('SELECT admin AS user, pass FROM adminauth WHERE admin = ?');
        } else {
            $stmt = $pdo->prepare('SELECT student AS user, pass FROM studentauth WHERE student = ?');
        }
        $stmt->execute([$username]);
        $result = $stmt->fetchAll();

        if (count($result) === 0 || !password_verify($_POST['pass'], 
                                     $result[0]['pass'])) {
            $error = "Invalid login attempt";
        } else {
            $_SESSION[$userType] = $username;
            header('Location: home.php?view=' . $username);
        }
    }
}

// Escape output to prevent XSS
$error_html_entities = htmlentities($error);
$username_html_entities = htmlentities($username);

?>

<!-- HTML login form -->
 <div class="registration-form">
    <form method="post" action="login.php">
        <div>
            <p class="error">
                <?php echo $error_html_entities; ?>
            </p>
        </div>

        <div>
            <p>
                Please enter your details to log in
            </p>
        </div>

        <div>
            <p>
                <label>User Type</label>
                <select name="userType">
                    <option value="student" <?php if ($userType === 'student') echo 'selected'; ?>>Student</option>
                    <option value="admin" <?php if ($userType === 'admin') echo 'selected'; ?>>Admin</option>
                </select>
            </p>
        </div>

        <div>
            <p>
                <label>Username</label>
                <input type="text" maxlength="16" name="username"
                value="<?php echo $username_html_entities; ?>">
            </p>
        </div>

        <div>
            <p>
                <label>Password</label>
                <input type="password" name="pass">
            </p>
        </div>

        <div>
            <p>
                <label></label>
                <input type="submit" value="Login">
            </p>
        </div>
   </form>
  </div>
 </body>
</html>