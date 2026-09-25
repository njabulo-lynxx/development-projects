<?php

   $numbers[0] = "one";
   $numbers[1] = "two";
   $numbers[2] = "three";
   $numbers[3] = "four";
   $numbers[4] = "five";

   for($index = 0; $index < count($numbers); $index++){
	   echo "\$numbers[$index] = " . $numbers[$index] . "<br>";
   }

?>