<?php

require_once "dbconn.php";

try{
    $stmt = $pdo->prepare("UPDATE products
                           SET Price = :price
                           WHERE ProductName = :name");
$stmt->execute([
    ":price" => 7.99,
    ":name" => "White Cheese"
]);

echo "The record has been updated successfully!";

}catch(PDOException $e){
	echo "update failed: " . $e->getMessage();
}

?>