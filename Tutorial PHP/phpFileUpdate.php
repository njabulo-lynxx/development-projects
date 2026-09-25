<?php

   $filename = "MyData.txt";

   //Function to display file contents with a label
   function displayFileContents($filename, $when) {
	   echo "<h4>File Contents $when Appending:</h4>";

	   if(file_exists($filename)) {
		   $content = file_get_contents($filename);
		   echo "<pre>$content</pre>";
	   } else {
		   echo "The file does not exist.<br>";
	   }
   }

   //Display contents BEFORE Appending
   displayFileContents($filename, "Before");

   //Prepare new record
   $newLine = "Lynx\tPR\t1099\n";

   //Append to the file
   $file = fopen($filename, "a");

   if($file){
	   fwrite($file, $newLine);
	   fclose($file);
	   echo "One record appended successfully! <br>";

	   //Display updated content
	   displayFileContents($filename, "After");
   } else {
	   echo "Error! Failed to open the file";
   }

?>