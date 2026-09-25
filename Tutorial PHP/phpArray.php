<?php

   //This is the 1st way to create an array
   //Use [square brackets] when dealing with arrays
   $numbers[0] = "one";
   $numbers[1] = "two";
   $numbers[2] = "three";
   $numbers[3] = "four";
   $numbers[4] = "five";

   //This is the 2nd way to create an array
   $alphabets = ["Apple", "Banana", "Carrot", "Duck", "Elephant"];

   //This is a way to view a created array
   echo "\$numbers[0] = " . $numbers[0] . "<br>";
   echo "\$numbers[1] = " . $numbers[1] . "<br>";
   echo "\$numbers[2] = " . $numbers[2] . "<br>";
   echo "\$numbers[3] = " . $numbers[3] . "<br>";
   echo "\$numbers[4] = " . $numbers[4] . "<br>";

   //This is another way to view a created array
   print_r($alphabets);
?>