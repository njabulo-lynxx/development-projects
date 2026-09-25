<?php

require_once "dbconn.php";

$stmt = $pdo->prepare("DELETE FROM products
                       WHERE ProductName = :name");
$stmt->execute([":name" => "Orange Crush Juice"]);

echo "Item deleted from product table";
?>