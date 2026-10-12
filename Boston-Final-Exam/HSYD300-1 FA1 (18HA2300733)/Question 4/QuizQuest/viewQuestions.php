<?php

//Show all values in the questions table
        function show_questions($pdo){
	    $stmt = $pdo->query("SELECT * 
		                     FROM questions");
	    echo "<table boarder='1'><tr><th>ID</th><th>Question</th><th>Type</th><th>Difficulty</th></tr>";
	    foreach($stmt as $row){
		    echo "<tr>
		              <td>{$row['id']}</td>
		    		  <td>" . htmlentities($row['question_text']) . "</td>
		    		  <td>" . htmlentities($row['question_type']) . "</td>
			    	  <td>" . htmlentities($row['difficulty']) . "</td>
		        </tr>";
	    }
	        echo "</table><br>";
}

?>