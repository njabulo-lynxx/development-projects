<?php

//Show all values in the leaderboard table
        function show_scores($pdo){
	    $stmt = $pdo->query("SELECT *
                             FROM leaderboard
                             ORDER BY score DESC");
	    echo "<table boarder='1'><tr><th>ID</th><th>Username</th><th>Score</th></tr>";
	    foreach($stmt as $row){
		    echo "<tr>
			          <td>{$row['id']}</td>
		    		  <td>" . htmlentities($row['user_name']) . "</td>
		    		  <td>{$row['score']}</td>
		        </tr>";
	    }
	        echo "</table><br>";
}

?>