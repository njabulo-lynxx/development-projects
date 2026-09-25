<?php

   //Define variables
   $leadActor = "Lynx";
   $supportActor = "Terrah";
   $director = "Tony Pepperoni";
   $producer = "Author Newgate";

   //Use compact to pact these into an associative array
   $movieTeam = compact("leadActor", "supportActor", "director", "producer");

   //Display the result
   print_r($movieTeam);

?>