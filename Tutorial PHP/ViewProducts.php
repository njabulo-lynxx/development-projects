<?php

require_once "dbconn.php";

$result = $pdo->query("SELECT * FROM Products");
echo "<h3> Current Product List:</h3>";

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	$name = htmlentities($row["ProductName"]);
	$category = htmlentities($row["Category"]);
	$stock = htmlentities($row["Stock"]);
	$price = htmlentities($row["Price"]);

	echo "$name - $category - $stock units - R$price<br>";
}

?>