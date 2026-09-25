<?php
// This file creates a report PDF for student

// Include database connection and header
require 'dbconn.php';
include 'header.php';

// Retrieve student name from session
$student_name = htmlentities($_SESSION['student']);

// Include library
include('library/tcpdf.php');

// Make TCPDF object
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// add a page
$pdf->AddPage();

// add content
$stmt = $pdo->prepare("SELECT full_name, student_id, email, dob, course, enrolment_date 
                       FROM studentInfo 
                       WHERE full_name = :full_name");
$stmt->bindParam(':full_name', $student_name);
$stmt->execute();
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// create HTML content
$html = '<h1>Student Report</h1>';
    $html .= "<p><strong>Full Name:</strong> " . htmlspecialchars($student['full_name']) . "</p>";
    $html .= "<p><strong>Student ID:</strong> " . htmlspecialchars($student['student_id']) . "</p>";
    $html .= "<p><strong>Email:</strong> " . htmlspecialchars($student['email']) . "</p>";
    $html .= "<p><strong>Date of Birth:</strong> " . htmlspecialchars($student['dob']) . "</p>";
    $html .= "<p><strong>Course:</strong> " . htmlspecialchars($student['course']) . "</p>";
    $html .= "<p><strong>Enrollment Date:</strong> " . htmlspecialchars($student['enrolment_date']) . "</p>";

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// PDF file name
$file_name = $student_name . "-report.pdf";
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