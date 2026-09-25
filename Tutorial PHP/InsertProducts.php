<?php

require_once "dbconn.php";

$products = [
         ["White Cheese", "Dairy", 50, 6.99],
         ["Blackberry Jelly", "Dessert", 41, 9.99],
         ["Orange Crush Juice", "Beverage", 98, 1.50],
         ["Stylos", "Snack", 50, 7.99]
];

$stmt = $pdo->prepare("INSERT INTO products(ProductName, Category, Stock, Price)
                      VALUES (:name, :category, :stock, :price)");

foreach($products as $p) {
    $stmt->bindValue(":name", $p[0]);
    $stmt->bindValue(":category", $p[1]);
    $stmt->bindValue(":stock", $p[2]);
    $stmt->bindValue(":price", $p[3]);
    $stmt->execute();
}

echo "--Products inserted successfully!--";

?>