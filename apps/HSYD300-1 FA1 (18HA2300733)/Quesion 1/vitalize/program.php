<?php
require_once("dbconn.php");

//Show all values in the program table
function show_program($pdo){
	$stmt = $pdo->query("SELECT * FROM program");
	echo "<table boarder='1'><tr><th>ID</th><th>Name</th><th>Description</th><th>Coach</th>
						         <th>Contact</th><th>Duration(week)</th><th>Skill-Level</th>
						     </tr>";
	foreach($stmt as $row){
		echo "<tr>
		          <td>{$row['id']}</td>
				  <td>" . htmlentities($row['program_name']) . "</td>
				  <td>" . htmlentities($row['description']) . "</td>
				  <td>" . htmlentities($row['coach_name']) . "</td>
				  <td>{$row['contact']}</td>
				  <td>{$row['duration']}</td>
				  <td>" . htmlentities($row['skill_level']) . "</td>
		      </tr>";
	}
	echo "</table><br>";
}

//Handle form actions
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$action = $_POST['action'];
	$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
	$name = htmlentities(trim($_POST['name'] ?? ''));
	$description = htmlentities(trim($_POST['description'] ?? ''));
	$coach = htmlentities(trim($_POST['coach'] ?? ''));
	$contact = filter_input(INPUT_POST, 'contact', FILTER_VALIDATE_INT);
	$duration = filter_input(INPUT_POST, 'duration', FILTER_VALIDATE_INT);
	$skill = htmlentities(trim($_POST['skill'] ?? ''));
	
	//Add values to the program table
	if($action === 'Add' && $name && $description !== false && $coach && $contact !== false && $duration && $skill !== false){
		$stmt = $pdo->prepare("INSERT INTO program(program_name, description, coach_name, contact, duration, skill_level)
		                       VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->execute([$name, $description, $coach, $contact, $duration, $skill]);
	}
	
	//Update values from the program table
	if($action === 'Update' && $id && $name && $description && $coach && $contact && $duration !== false){
		$stmt = $pdo->prepare("UPDATE program
							   SET program_name = ?, description = ?, coach_name = ?, 
							       contact = ?, duration = ?, skill_level = ?
							   WHERE id = ?");
		$stmt->execute([$name, $description, $coach, $contact, $duration, $skill, $id]);
	}
	
	//View values from the program table
	if($action === 'View'){
		show_program($pdo);
	}
	
	//Delete values from the program table
	if($action === 'Delete' && $id){
		$stmt = $pdo->prepare("DELETE FROM program
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

    <h1>Gymnastics Programs</h1>
	
	<form method="post">
         <table class="form-table">
             <tr>
                 <td><lable for="id">Program ID:</lable></td>
                 <td><input type="number" name="id" id="id"></td>
             </tr>
             <tr>
                 <td><lable for="name">Program Name:</label></td>
                 <td><input type="text" name="name" id="name"></td>
             </tr>
			 <tr>
                 <td><lable for="description">Description:</label></td>
                 <td><input type="text" name="description" id="description"></td>
             </tr>
			 <tr>
                 <td><lable for="coach">Coach Name:</label></td>
                 <td><input type="text" name="coach" id="coach"></td>
             </tr>
			 <tr>
                 <td><lable for="contact">Contact::</label></td>
                 <td><input type="number" name="contact" id="contact"></td>
             </tr>
             <tr>
                 <td><lable for="duration">Duration (weeks):</label></td>
                 <td><input type="number" name="duration" id="duration"></td>
             </tr>
             <tr>
                 <td><label for="skill">Skill Level:</lable></td>
                 <td><select id="skill" name="skill">
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
</body>
</html>