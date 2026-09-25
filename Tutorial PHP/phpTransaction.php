<?php

$pdo = new PDO("mysql:host=localhost;dbname=shipping", "root", "Password");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Sample input
$product_id = 3;
$quantity_to_ship = 5;

try{
    $pdo->beginTransaction();

	//Step #1 : Check current stock
	$stmt =$pdo->prepare("SELECT stock FROM product
                          WHERE id = ?");
	$stmt->execute([$product_id]);
	$stock = $stmt->fetchColumn();

	if ($stock === false || $stock < $quantity_to_ship) {
	throw new Exception("Insufficient stock for shipment.");
}
    //Step #2 : Deduct stock
	$stmt = $pdo->prepare("UPDATE product
                    SET stock = stock - ?
                    WHERE id = ?");
    $stmt->execute([$quantity_to_ship, $product_id]);

	//Step #3 : Log shipment
	$stmt = $pdo->prepare("INSERT INTO shipment (product_id, quantity, shipped_at)
                    VALUES (?, ?, NOW())");
	$stmt->execute([$product_id, $quantity_to_ship]);

	$pdo->commit();
	echo "Shipment processed successfully!";

} catch(Exception $e) {
	$pdo->rollBack();
	echo "Transaction was unsuccessful: " . $e->getMessage();
}

?>