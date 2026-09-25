<?php
// This is a combined login.php file for both customers and admins
// It uses a dropdown to select user type and processes login accordingly.

require_once 'header.php';

$error = $username = "";

// Default to customer login
$userType = isset($_POST['userType']) ? $_POST['userType'] : 'customer';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    if ($username === "" || $_POST['pass'] === "")
        $error = 'Not all fields were entered';
    else {
        if ($userType === 'admin') {
            $stmt = $pdo->prepare('SELECT admin AS user, pass 
                                   FROM adminauth 
                                   WHERE admin = ?');
        } else {
            $stmt = $pdo->prepare('SELECT customer AS user, pass 
                                   FROM customers1 
                                   WHERE customer = ?');
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in page</title>
</head>
<body>
    <!-- HTML login form -->
 <div>
    <div class="border">
    <form method="post" action="login.php">
        <div class="error">
            <?php echo $error_html_entities; ?>
            <p>Please enter your details to log in</p>
        </div>

        <div>
            <label>User Type</label>
            <select name="userType">
                <option value="customer" <?php if ($userType === 'customer') echo 'selected'; ?>>Customer</option>
                <option value="admin" <?php if ($userType === 'admin') echo 'selected'; ?>>Admin</option>
            </select>
        </div>

        <div>
            <label>Username</label>
            <input type="text" maxlength="16" name="username"
            value="<?php echo $username_html_entities; ?>">
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="pass">
        </div>

        <div>
            <label></label>
            <input type="submit" value="Login">
        </div>
   </form>
  </div>
  </div>
</body>
</html>