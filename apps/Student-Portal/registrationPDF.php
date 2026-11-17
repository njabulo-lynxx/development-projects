<?php
// This file generates registration confirmation slip PDF

// Include database connection and header
require 'dbconn.php';
include 'header.php';

// Retrieve student name from session
$student_name = $_POST['full_name'];

// Include library
include('library/tcpdf.php');

// Make TCPDF object
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// add a page
$pdf->AddPage();

// add content
$stmt = $pdo->prepare("SELECT full_name, course, enrolment_date, academic_status 
                       FROM studentInfo 
                       WHERE full_name = ?");
$stmt->execute([$student_name]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// create HTML content
$html = '<h1>Registration Confirmation Slip</h1>';
    $html .= "<p><strong>Student Name:</strong> " . htmlspecialchars($student['full_name']) . "</p>";
    $html .= "<p><strong>Course:</strong> " . htmlspecialchars($student['course']) . "</p>";
    $html .= "<p><strong>Enrollment Date:</strong> " . htmlspecialchars($student['enrolment_date']) . "</p>";
    $html .= "<p><strong>Academic Status:</strong> " . htmlspecialchars($student['academic_status']) . "</p>";

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// PDF file name
$file_name = "confirmation-slip.pdf";
ob_end_clean();

// output the PDF
if($_GET['ACTION']=='VIEW') 
{
	$pdf->Output($file_name, 'I'); // I means Inline view
} 
else if($_GET['ACTION']=='DOWNLOAD')
{
	$pdf->Output($file_name, 'D'); // D means download
}

?>