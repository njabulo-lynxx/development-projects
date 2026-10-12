<?php
require_once 'header.php';

// Initialize variable
$error = $customer = "";

// Destroy any existing session
if (isset($_SESSION['customer']))
    destroySession();

// Process form submission
if (isset($_POST['customer'])) {
    $customer = $_POST['customer'];
    if ($_POST['customer'] === "" || $_POST['pass'] === "")
        $error = 'Not all fields were entered';
    else {
        $stmt = $pdo->prepare('SELECT * FROM customers1 WHERE customer = ?');
        $stmt->execute([$customer]);
        if ($stmt->rowCount())
            $error = 'That username already exists';
        else {
            $stmt = $pdo->prepare('INSERT INTO customers1 VALUES(null, ?, ?)');
            $stmt->execute([$customer, password_hash($_POST['pass'], PASSWORD_DEFAULT)]);
            die('<h1>Customer account has been created successfully!</h1>');
        }
    }
}

// Escape output for HTML
$error_html_entities = htmlentities($error);
$customer_html_entities = htmlentities($customer);
?>

<div class="border">
<form method="post" action="register_customer.php">
    <div class="error">
        <?php echo $error_html_entities; ?> 
    </div>

    <div>
        <h1><b>Create a Customer account</b></h1>
    </div>

    <div>
            <label>Username</label>
            <input type="text" maxlength="50" name="customer" id="username"
             value="<?php echo $customer_html_entities; ?>">
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
</div>

    </form>
    <script>
        // Javascript to verify user
        const field = byId('username');
        field.onblur = () => {
            if (field.value === '')
                return
            const data = new FormData()
            data.set('customer', field.value)
            fetch('verifyuser.php', { method: 'post', body: data})
                 .then(response => response.text())
                 .then(text => byId('used').innerHTML = text)
        }
    </script>
 </body>    
</html>