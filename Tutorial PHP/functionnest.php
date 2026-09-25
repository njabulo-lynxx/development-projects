<?php
   
  $myText = "pRoJEct mISt";
  //convert the above letters to lowercase and submit only the first letter to upper
  echo "The original text was {$myText}. The new text is ";
  echo ucfirst(strtolower($myText));

?>