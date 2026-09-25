<?php
//Use try and catch to trap errors
try{
	$pdo = new PDO("mysql:host=localhost;port = 3306;dbname=quiz", "root", "Password");
} catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

?>