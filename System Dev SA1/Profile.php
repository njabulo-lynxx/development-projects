<?php
// This file displays all student profiles

// Include header and database connection
require 'header.php';
require_once 'dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php

    // Fetch all students to render the full list on the page
    $stmt = $pdo->query("SELECT * FROM studentinfo");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="all-students">
        <h2>Student Profiles</h2>
        <?php if (empty($students)): ?>
            <p>No student information found.</p>
        <?php else: ?>
            <?php foreach ($students as $s): ?>
                <div class="student-card">
                    <?php foreach ([
                        'Full Name' => 'full_name',
                        'Student ID' => 'student_id',
                        'Email' => 'email',
                        'Date of Birth' => 'dob',
                        'Course' => 'course',
                        'Duration' => 'year',
                        'Academic status' => 'academic_status',
                        'Enrollment Date' => 'enrolment_date'
                    ] as $label => $key): ?>
                        <p><strong><?php echo $label; ?>:</strong> <?php echo htmlspecialchars($s[$key] ?? ''); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>

