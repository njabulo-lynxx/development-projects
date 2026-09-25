<?php

$animals[0] = "Cat";
    $animals[1] = "Dog";
    $animals[2] = "Chicken";
    $animals[3] = "Baboon";
    $animals[4] = "Zebra";

    echo "Sorted Array: <br>";
    sort($animals);
    foreach($animals as $key => $value) {
        echo "Key: $key; Value: $value <br>";
    }

    echo "<br><br>Reverse Sorted Array: <br>";
    rsort($animals);
    foreach($animals as $key => $value) {
        echo "Key: $key; Value: $value <br>";
    }

?>