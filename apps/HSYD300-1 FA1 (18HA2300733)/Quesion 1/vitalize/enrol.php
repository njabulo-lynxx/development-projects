<?php
require_once("dbconn.php");

//Show all values in the enrolment table
function show_enrolment($pdo){
	$stmt = $pdo->query("SELECT * FROM enrolment");
	echo "<table boarder='1'><tr><th>ID</th><th>Name</th><th>Age</th><th>Experience</th></tr>";
	foreach($stmt as $row){
		echo "<tr>
		          <td>{$row['id']}</td>
				  <td>" . htmlentities($row['gymnast_name']) . "</td>
				  <td>{$row['age']}</td>
				  <td>" . htmlentities($row['experience_level']) . "</td>
		      </tr>";
	}
	echo "</table><br>";
}

//Handle form actions
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$action = $_POST['action'];
	$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
	$name = htmlentities(trim($_POST['name'] ?? ''));
	$age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
	$experience = htmlentities(trim($_POST['experience'] ?? ''));
	
	//Add values to the enrolment table
	if($action === 'Add' && $name && $age !== false && $experience !== false){
		$stmt = $pdo->prepare("INSERT INTO enrolment(gymnast_name, age, experience_level)
		                       VALUES (?, ?, ?)");
		$stmt->execute([$name, $age, $experience]);
	}
	
	//Update values from the enrolment table
	if($action === 'Update' && $id && $name && $age !== false){
		$stmt = $pdo->prepare("UPDATE enrolment
							   SET gymnast_name = ?, age = ?, experience_level = ?
							   WHERE id = ?");
		$stmt->execute([$name, $age, $experience, $id]);
	}
	
	//View values from the enrolment table
	if($action === 'View'){
		show_enrolment($pdo);
	}
	
	//Delete values from the enrolment table
	if($action === 'Delete' && $id){
		$stmt = $pdo->prepare("DELETE FROM enrolment
						       WHERE id = ?");
		$stmt->execute([$id]);
	}
	
}

?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
    <header>
	    <h1>Enrolment Form</h1>
	</header>
	
	<main>
	    <form method="post">
         <table class="form-table">
             <tr>
                 <td><lable for="id">Gymnast ID:</lable></td>
                 <td><input type="number" name="id" id="id"></td>
             </tr>
             <tr>
                 <td><lable for="name">Name:</label></td>
                 <td><input type="text" name="name" id="name"></td>
             </tr>
             <tr>
                 <td><lable for="age">Age:</label></td>
                 <td><input type="number" name="age" id="age"></td>
             </tr>
             <tr>
                 <td><label for="experience">Experience Level:</lable></td>
                 <td><select id="experience" name="experience">
				     <option value="Beginner">Beginner</option>
					 <option value="Intermediate">Intermediate</option>
					 <option value="Advanced">Advanced</option>
				 </select>
				 </td>
             <tr>
                 <td colspan="2">
					 <input type="submit" name="action" value="Add">
					 <input type="submit" name="action" value="Update">
					 <input type="submit" name="action" value="View">
                     <input type="submit" name="action" value="Delete">
                 </td>
             </tr>
         </table>
     </form>
	</main>

     <footer>
	 </footer>
	 
</body>
</html>