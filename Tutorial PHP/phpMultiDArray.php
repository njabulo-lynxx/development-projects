<?php

   $office = [
        "Lynx" => ["desk" => "D1", "role" => "Finance"],
        "Terrah" => ["desk" => "B1", "role" => "HR"]
   ];

   foreach($office as $name => $details) {
       echo "$name works in {$details['role']} at desk {$details['desk']}" . "<br>";
   }

?>