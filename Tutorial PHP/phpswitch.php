<?php

   $age = 22;

   switch(true) {
	   case($age >= 0 && $age <= 2):
	   echo "{$age} years means infant";
	   break;
	   case($age >= 3 && $age <= 6):
	   echo "{$age} years means child";
	   break;
	   case($age >= 7 && $age <= 12):
	   echo "{$age} years means preteen";
	   break;
	   case($age >= 13 && $age <= 19):
	   echo "{$age} years means teenager";
	   break;
	   case($age >= 20 && $age <= 59):
	   echo $age , " years means adult";
	   break;
	   case($age >= 60):
	   echo "{$age} years means elderly";
	   break;
	   default:
	   echo "You entered an invalid age";
   }

?>