<?php
  
  $minutes = 25;
  if($minutes > 30)
  {
	  echo "You have been using the laptop for {$minutes} minutes. <br>";
	  echo "Please close all of the apps.";
  } else {
	  echo "You have been using the laptop for {$minutes} minutes <br>";
	  echo "Know that you should close all apps when you reach 30 minutes.";
  }

?>