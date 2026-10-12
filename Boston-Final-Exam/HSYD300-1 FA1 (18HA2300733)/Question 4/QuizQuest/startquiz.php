<?php
require_once("dbconn.php");

$textbox_value = "";

if(isset($_POST['exit'])) {
         header('Location: Dashboard.php');
     }

if (isset($_POST['submit'])) {
        $textbox_value = $_POST['username']; // Keep the submitted value
        // Perform validation or other processing
    }

        //Handle form actions
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
	    $action = $_POST['action'];
        $username = htmlentities(trim($_POST['user_name'] ?? ''));
        $score = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        //Create username and score in leaderboard
	    if($action === 'Complete' && $username && $score !== false){
		$stmt = $pdo->prepare("INSERT INTO leaderboard(user_name, score)
		                       VALUES (?, ?)");
		$stmt->execute([$username, $score]);
           echo "The score has been added!";
	     }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>START QUIZ QUEST</title>
</head>
<header>
        <h1>The Ultimate Trivia Challenge</h1>
    </header>
<body>
    <form method="post" action="">
        <pre>
<b>To begin the quiz please enter your name</b>

<input type= "text" name= "username" size= "20" maxlength= "20" value="<?php echo htmlspecialchars($textbox_value); ?>"> 

<input type= "submit" name= "submit" value= "begin">

Current Score: <input type="number" name="score" value="0" size="3" maxlength="3"> 

               <input type= "submit" name= "action" value= "Complete">
        <?php
        
        if(isset($_POST['submit']) && !empty($_POST['username'])) {
        
        $result = $pdo->query("SELECT * FROM questions");
        echo "<h3> Questions: </h3>";

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	    $question_text = htmlentities($row["question_text"]);
	    $question_type = htmlentities($row["question_type"]);
	    $difficulty = htmlentities($row["difficulty"]);
        $option_1 = htmlentities($row["option_1"]);
        $option_2 = htmlentities($row["option_2"]);
        $option_3 = htmlentities($row["option_3"]);
        $option_4 = htmlentities($row["option_4"]);

echo "<br>$question_text <br>A. $option_1 <br>B. $option_2 <br>C. $option_3 <br>D. $option_4 <br>";

       }
    } 
        ?>
        
               <input type= "submit" name= "exit" value= "dashboard">
        </pre>
    </form>
</body>
</html>