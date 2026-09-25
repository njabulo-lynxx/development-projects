<?php

  //Define the file name
  $filename = "MyData.txt";

  //Prepare the content
  $content = "Name\tDepartment\tExtension\n";
  $content .= "Tony\tFinance\t1010\n";
  $content .= "Terrah\tHR\t1014\n";
  $content .= "Inverse\tIT\t1041\n";
  $content .= "Reverse\tIT\t1041\n";

  //Open the file in write mode (Creates the file if it doesn't exist)
  $file = fopen($filename, "w");

  if($file) {
	  //Write the content to the file
	  fwrite($file, $content);

	  //Close the file
	  fclose($file);
	  echo "File '$filename' created successfully!";
  } else {
	  echo "Unable to create the file";
  }

?>