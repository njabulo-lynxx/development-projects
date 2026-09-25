<?php
// This page allows logged in students to generate their own PDF report
require 'header.php';
?>

<!-- html code for generating student report PDF -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Student Report</title>
</head>
<body>
    <div>
        <a href="reportPDF.php? ACTION=VIEW" 
           class="btn btn-success"><i class="fa fa-file-pdf-o">
           </i> View PDF</a> &nbsp;&nbsp; 
	    <a href="reportPDF.php? ACTION=DOWNLOAD" 
           class="btn btn-primary"><i class="fa fa-download">
           </i> Download PDF</a> &nbsp;&nbsp;
	</div>
</body>
</html>