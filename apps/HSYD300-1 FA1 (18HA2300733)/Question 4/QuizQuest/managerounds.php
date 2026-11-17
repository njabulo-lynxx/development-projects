<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MANAGE QUIZ ROUNDS</title>
</head>
<body>
    <header>
        <h1>Manage your questions</h1>
    </header>

    <main>
	    <form method="post">
         <table class="form-table">
             <tr>
                 <td><lable for="id">Question ID:</lable></td>
                 <td><input type="number" name="id" id="id"></td>
             </tr>
             <tr>
                 <td><lable for="question">Question:</label></td>
                 <td><input type="text" name="question" id="question" size="50" maxlength="255"></td>
             </tr>
             <tr>
                 <td><label for="question_type">Question Type:</lable></td>
                 <td><select id="question_type" name="question_type">
				     <option value="multiple_choice">Multiple-choice</option>
					 <option value="open_ended">Open-ended</option>
				 </select>
				 </td>
             </tr>
             <tr>
                 <td><lable for="option_1">A:</label></td>
                 <td><input type="text" name="option_1" id="option_1" size="50" maxlength="255"></td>
             </tr>
             <tr>
                 <td><lable for="option_2">B:</label></td>
                 <td><input type="text" name="option_2" id="option_2" size="50" maxlength="255"></td>
             </tr>
             <tr>
                 <td><lable for="option_3">C:</label></td>
                 <td><input type="text" name="option_3" id="option_3" size="50" maxlength="255"></td>
             </tr>
             <tr>
                 <td><lable for="option_4">D:</label></td>
                 <td><input type="text" name="option_4" id="option_4" size="50" maxlength="255"></td>
             </tr>
             <tr>
                 <td><label for="difficulty">Difficulty:</lable></td>
                 <td><select id="difficulty" name="difficulty">
				     <option value="Beginner">Beginner</option>
					 <option value="Intermediate">Intermediate</option>
					 <option value="Advanced">Advanced</option>
				 </select>
				 </td>
             <tr>
                 <td colspan="2">
                     <input type="submit" name="action" value="Update Question">
                     <input type="submit" name="action" value="View Question">
                 </td>
             </tr>
             <tr>
                 <td><lable for="score_id">Score ID:</lable></td>
                 <td><input type="number" name="score_id" id="score_id" size="3" maxlength="3"></td>
             </tr>
             <tr>
                 <td><lable for="user_name">Username:</lable></td>
                 <td><input type="text" name="user_name" id="user_name" size="10" maxlength="10"></td>
             </tr>
             <tr>
                 <td><lable for="score">score:</lable></td>
                 <td><input type="number" name="score" id="score" size="3" maxlength="3"></td>
             </tr>
             <td colspan="2">
                     <input type="submit" name="action" value="Update Score">
					 <input type="submit" name="action" value="View Score">
                     <input type="submit" name="exit" value="dashboard">
                 </td>
         </table>
     </form>
	</main>
    </form>
</body>
</html>

<?php
require_once("dbconn.php");
require_once("viewQuestions.php");
require_once("viewScores.php");

if(isset($_POST['exit'])) {
         header('Location: Dashboard.php');
     }

        //Handle form actions
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
	    $action = $_POST['action'];
	    $question_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
	    $question = htmlentities(trim($_POST['question'] ?? ''));
	    $question_type = htmlentities(trim($_POST['question_type'] ?? ''));
	    $difficulty = htmlentities(trim($_POST['difficulty'] ?? ''));
        $option_1 = htmlentities(trim($_POST['option_1'] ?? ''));
        $option_2 = htmlentities(trim($_POST['option_2'] ?? ''));
        $option_3 = htmlentities(trim($_POST['option_3'] ?? ''));
        $option_4 = htmlentities(trim($_POST['option_4'] ?? ''));
        $score_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $username = htmlentities(trim($_POST['user_name'] ?? ''));
        $score = filter_input(INPUT_POST, 'score', FILTER_VALIDATE_INT);

         //Update values from the questions table
	     if($action === 'Update Question' && $question_id && $question && $question_type && $difficulty !== false){
		 $stmt = $pdo->prepare("UPDATE questions
							   SET question_text = ?, question_type = ?, difficulty = ?,
                               option_1 = ?, option_2 = ?, option_3 = ?, option_4 = ?
							   WHERE id = ?");
		 $stmt->execute([$question, $question_type, $difficulty, $option_1, 
                         $option_2, $option_3, $option_4, $question_id]);
        
        echo "Update completed successfully!";
	}

        //Update values from the leaderboard table
	     if($action === 'Update Score' && $username && $score !== false){
		 $stmt = $pdo->prepare("UPDATE leaderboard
							   SET user_name = ?, score = ?
							   WHERE id = ?");
		 $stmt->execute([$username, $score, $score_id]);
        
        echo "Update completed successfully!";
	}
        
        echo "<br>";
        //View values from the questions table
	    if($action === 'View Question'){
		show_questions($pdo);
	}

        echo "<br>";
        //View values from the leaderboard table
	    if($action === 'View Score'){
		show_Scores($pdo);
	}

    }
     
?>