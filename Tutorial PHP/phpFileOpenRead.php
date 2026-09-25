<?php

  if(!file_exists("MyData.txt")) { //Check if file exists
	  die("File not found!");
  }

  $fh = fopen("MyData.txt", "r") or die("Can't open the file");
  $content = fread($fh, filesize("MyData.txt"));
  fclose($fh);
  echo "<pre>" . htmlspecialchars($content) . "</pre>";

?>