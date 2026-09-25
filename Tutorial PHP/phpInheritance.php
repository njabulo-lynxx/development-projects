<?php
//Parent class

class Product {
	public $name;
	public $price;

	public function display() {
		echo "$this->name costs R$this->price <br>";
	}
}

//Child class
class Laptop extends Product {
	public $brand;

	public function displayBrand() {
		echo "Brand: $this->brand <br>";
	}
}

$laptop = new Laptop();
$laptop->name = "Packard Bell";
$laptop->price = 4000;
$laptop->brand = "Dell";
$laptop->display();
$laptop->displayBrand();

?>