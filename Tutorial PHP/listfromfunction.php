<?

function getPerson() {
	return ['Lynx', 22, 'Farmer'];
}

list($name, $age, $profession) = getPerson();

echo "Name: {$name} <br>";
echo "Age: {$age} <br>";
echo "Profession: {$profession} <br>";

?>