<?php
// This page displays the profile information of the logged-in student.

// Start the session and include necessary files
require 'header.php';
require_once 'dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
</head>
<body>
    <?php
    $username = $_SESSION['student'];
    $stmt = $pdo->prepare("SELECT * FROM studentinfo WHERE full_name = ?");
    $stmt->execute([$username]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display student information with improved styling
    echo "<style>
        .student-profile {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: lightblue;
        }
        .student-profile h2 {
            color: #333;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .student-profile p {
            margin: 10px 0;
            padding: 8px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }
        .student-profile strong {
            color: #444;
            display: inline-block;
            width: 150px;
        }
    </style>";
    if ($student) {
        echo "<div class='student-profile'>";
        echo "<h2>Student Details</h2>";
        echo "<p><strong>Full Name:</strong> " . htmlspecialchars($student['full_name']) . "</p>";
        echo "<p><strong>Student ID:</strong> " . htmlspecialchars($student['student_id']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($student['email']) . "</p>";
        echo "<p><strong>Date of Birth:</strong> " . htmlspecialchars($student['dob']) . "</p>";
        echo "<p><strong>Course:</strong> " . htmlspecialchars($student['course']) . "</p>";
        echo "<p><strong>Duration:</strong> " . htmlspecialchars($student['year']) . " years" . "</p>";
        echo "<p><strong>Academic status:</strong> " . htmlspecialchars($student['academic_status']) . "</p>";
        echo "<p><strong>Enrollment Date:</strong> " . htmlspecialchars($student['enrolment_date']) . "</p>";
        echo "</div>";
    } else {
        echo "<p>No student information found.</p>";
    }

    ?>
</body>
</html>

