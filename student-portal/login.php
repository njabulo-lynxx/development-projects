<?php
require 'header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $userType = $_POST['userType'] ?? '';
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  if (empty($userType)) {
    $errors[] = "UserType is required.";
  } elseif ($userType !== 'student' && $userType !== 'admin') {
    $errors[] = "Invalid user type.";
  }

  if (empty($username)) {
    $errors[] = "Username is required.";
  }

  if (empty($password)) {
    $errors[] = "Password is required.";
  }

  if (empty($errors)) {
    echo "Validation successful!";
  } else {
    foreach ($errors as $error) {
      echo "<p>$error</p>";
    }
  }

} else {
  echo '<p>Form has not been submitted.</p>';
}

?>

<main>

  <section class="login">

    <h1>Login</h1>

    <form action="login.php" method="post">
      <input type="radio" id="student" name="userType" value="student" required>
      <label for="student">student</label>

      <input type="radio" id="admin" name="userType" value="admin">
      <label for="admin">admin</label>

      <label for="username">Username</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Login</button>
    </form>

  </section>

</main>

<?php
require 'footer.php';
?>