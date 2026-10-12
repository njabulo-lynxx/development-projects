<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELETE QUESTIONS</title>
</head>
<header>
        <h1>Delete Questions and Scores</h1>
    </header>
<body>
    <form method="post" action="">
         <table class="form-table">
             <tr>
                 <td><lable for="id">Question ID:</lable></td>
                 <td><input type="number" name="id" id="id"></td>
             </tr>
         </table>
        <pre>
            <input type="submit" name="action" value="Delete">

            <input type="submit" name="exit" value="dashboard">
        </pre>
    </form>
</body>
</html>

<?php
require_once("dbconn.php");
require_once("viewQuestions.php");

if(isset($_POST['exit'])) {
         header('Location: Dashboard.php');
     }

        //Handle form actions
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
	    $action = $_POST['action'];
	    $question_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        
        //Delete questions from the questions table
	    if($action === 'Delete' && $question_id){
		$stmt = $pdo->prepare("DELETE FROM questions
						       WHERE id = ?");
		$stmt->execute([$question_id]);

        echo "The question has been deleted successfully!";
	}
  }
     show_questions($pdo);
?>