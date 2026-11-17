<?php
// The admin can manage student details here

// Include header and database connection
require_once 'header.php';
require_once 'dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Management</title>
</head>
<body>
    <?php

    $message = '';

    // Handle POST actions: create, update, delete
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // Delete action
            if (!empty($_POST['delete_id'])) {
                $delete_id = $_POST['delete_id'];
                $stmt = $pdo->prepare("DELETE FROM studentinfo 
                                       WHERE student_id = ?");
                if ($stmt->execute([$delete_id])) {
                    $message = "<p class='success'>Student deleted successfully.</p>";
                } else {
                    $message = "<p class='error'>Delete failed.</p>";
                }
            }
            
            // Update action
            elseif (!empty($_POST['action']) && $_POST['action'] === 'update' 
                                             && !empty($_POST['student_id'])) {
                $full_name = $_POST['full_name'] ?? '';
                $student_id = $_POST['student_id'] ?? '';
                $email = $_POST['email'] ?? '';
                $dob = $_POST['dob'] ?? null;
                $course = $_POST['course'] ?? '';
                $year = $_POST['year'] ?? '';
                $enrolment_date = $_POST['enrolment_date'] ?? null;
                $academic_status = $_POST['academic_status'] ?? 'active';

                $stmt = $pdo->prepare("UPDATE studentinfo 
                                       SET full_name = ?, email = ?, dob = ?, course = ?, year = ?, enrolment_date = ?, academic_status = ? 
                                       WHERE student_id = ?");
                if ($stmt->execute([$full_name, $email, $dob, $course, $year, $enrolment_date, $academic_status, $student_id])) {
                    $message = "<p class='success'>Update successful.</p>";
                } else {
                    $message = "<p class='error'>Update failed.</p>";
                }

                
            }
            // Create action (default)
            else {
                $full_name = $_POST['full_name'] ?? '';
                $student_id = $_POST['student_id'] ?? '';
                $email = $_POST['email'] ?? '';
                $dob = $_POST['dob'] ?? null;
                $course = $_POST['course'] ?? '';
                $year = $_POST['year'] ?? '';
                $enrolment_date = $_POST['enrolment_date'] ?? null;
                $academic_status = $_POST['academic_status'] ?? 'active';

                $stmt = $pdo->prepare("INSERT INTO studentinfo (full_name, student_id, email, dob, course, year, enrolment_date, academic_status) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                if ($stmt->execute([$full_name, $student_id, $email, $dob, $course, $year, $enrolment_date, $academic_status])) {
                    $message = "<p class='success'>Student registered successfully!</p>";
                } else {
                    $message = "<p class='error'>Error: could not insert student.</p>";
                }
            }
        } catch (Exception $e) {
            $message = "<p class='error'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    // If editing, fetch the student's data to prefill the form
    $editing = false;
    $edit_data = [
        'full_name' => '',
        'student_id' => '',
        'email' => '',
        'dob' => '',
        'course' => '',
        'year' => '',
        'academic_status' => '',
        'enrolment_date' => ''
    ];

    if (!empty($_GET['edit'])) {
        $edit_id = $_GET['edit'];
        $stmt = $pdo->prepare("SELECT full_name, student_id, email, dob, course, year, academic_status, enrolment_date 
                               FROM studentinfo 
                               WHERE student_id = ?");
        $stmt->execute([$edit_id]);
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $edit_data = $row;
            $editing = true;
        }
    }

    // Fetch all students for display
    $students = [];
    $stmt = $pdo->query("SELECT full_name, student_id, email, dob, course, year, academic_status, enrolment_date 
                         FROM studentinfo 
                         ORDER BY full_name ASC");
    if ($stmt !== false) {
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>

    <?php echo $message; ?>

    <form method="post" action="management.php" novalidate>
        <fieldset>
            <legend>
                <h2><?php echo $editing ? 'Update Student' : 'Student Registration'; ?></h2>
            </legend>

            <div class="registration-form">
                <!-- Form fields -->

                <!-- Full name, Student ID are read-only when editing -->
                <label for="full_name">Full name</label>
                <input type="text" id="full_name" name="full_name" maxlength="50" required aria-required="true" 
                    value="<?php echo htmlspecialchars($edit_data['full_name']); ?>" 
                           <?php echo $editing ? 'readonly' : ''; ?> /><br /> <!-- make read-only when editing -->

                <label for="student_id">Student ID</label>
                <input type="text" id="student_id" name="student_id" maxlength="16" required pattern="\S+" aria-required="true" 
                    value="<?php echo htmlspecialchars($edit_data['student_id']); ?>" 
                           <?php echo $editing ? 'readonly' : ''; ?> /><br /> <!-- make read-only when editing -->

                <!-- Other fields are editable -->
                <label for="email">Email</label>
                <input type="email" id="email" name="email" maxlength="50" required aria-required="true" 
                    value="<?php echo htmlspecialchars($edit_data['email']); ?>" /><br />

                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required aria-required="true" 
                    value="<?php echo htmlspecialchars($edit_data['dob']); ?>" /><br />

                <label for="course">Course</label>
                <select id="course" name="course" required aria-required="true">
                    <option value="">Select course</option>
                    <option value="cs" <?php echo ($edit_data['course'] === 'cs') ? 'selected' : ''; ?>>Computer Science</option>
                    <option value="it" <?php echo ($edit_data['course'] === 'it') ? 'selected' : ''; ?>>Information Technology</option>
                    <option value="business" <?php echo ($edit_data['course'] === 'business') ? 'selected' : ''; ?>>Business</option>
                </select><br />

                <label for="year">Year</label>
                <select id="year" name="year" required aria-required="true">
                    <option value="">Select year</option>
                    <option value="1" <?php echo ($edit_data['year'] === '1') ? 'selected' : ''; ?>>1</option>
                    <option value="2" <?php echo ($edit_data['year'] === '2') ? 'selected' : ''; ?>>2</option>
                    <option value="3" <?php echo ($edit_data['year'] === '3') ? 'selected' : ''; ?>>3</option>
                    <option value="4" <?php echo ($edit_data['year'] === '4') ? 'selected' : ''; ?>>4</option>
                </select><br />

                <label for="academic_status">Academic Status</label>
                <select id="academic_status" name="academic_status" required aria-required="true">
                    <option value="">Select status</option>
                    <option value="active" <?php echo ($edit_data['academic_status'] ?? '') === 'active' ? 'selected' : ''; ?>>Active</option>
                    <option value="probation" <?php echo ($edit_data['academic_status'] ?? '') === 'probation' ? 'selected' : ''; ?>>Probation</option>
                    <option value="suspended" <?php echo ($edit_data['academic_status'] ?? '') === 'suspended' ? 'selected' : ''; ?>>Suspended</option>
                    <option value="graduated" <?php echo ($edit_data['academic_status'] ?? '') === 'graduated' ? 'selected' : ''; ?>>Graduated</option>
                </select><br />

                <label for="enrolment_date">Enrolment Date</label>
                <input type="date" id="enrolment_date" name="enrolment_date" required aria-required="true" 
                    value="<?php echo htmlspecialchars($edit_data['enrolment_date']); ?>" /><br />
            
                <?php if ($editing): ?>
                    <input type="hidden" name="action" value="update" />
                    <button type="submit">Update student</button>
                    <a href="management.php"><button type="button">Cancel</button></a>
                <?php else: ?>
                    <button type="submit">Register student</button>
                    <button type="reset">Reset</button>
                <?php endif; ?>

                <!-- End of form fields -->
            </div>
        </fieldset>
    </form>

    <hr />

    <div class="table-registered-students">
    <h2><b>Registered Students<b></h2>
    <?php if (empty($students)): ?>
        <p>No students registered yet.</p>
    <?php else: ?>
        <!-- Display students in a table -->

        <table border="3" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Full name</th>
                    <th>Student ID</th>
                    <th>Email</th>
                    <th>DOB</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Enrolment Date</th>
                    <th>Academic Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $s): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($s['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($s['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($s['email']); ?></td>
                        <td><?php echo htmlspecialchars($s['dob']); ?></td>
                        <td><?php echo htmlspecialchars($s['course']); ?></td>
                        <td><?php echo htmlspecialchars($s['year']); ?></td>
                        <td><?php echo htmlspecialchars($s['enrolment_date']); ?></td>
                        <td><?php echo htmlspecialchars($s['academic_status']); ?></td>
                        <td>
                            <!-- add edit button -->
                            <div> 
	                         <a href="management.php?edit=<?php echo urlencode($s['student_id']); ?>&ACTION=" 
                                class="btn btn-danger"><i class="fa fa-download"></i> 
                                       Edit Student</a> &nbsp;&nbsp;

                            <!-- add delete button -->     
                            <form method="post" action="management.php" style="display:inline" 
                                  onsubmit="return confirm('Delete student <?php echo htmlspecialchars(addslashes($s['full_name'])); ?>?');">
                                <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($s['student_id']); ?>" />
                                <button type="submit" class="btn btn-success">Delete Student</button>
                            </form>
	                        </div>

                            <!-- add button to download & View registration slip -->
                            <div>
                                <a href="registrationPDF.php? ACTION=VIEW" 
                                    class="btn btn-info"><i class="fa fa-file-pdf-o"></i>
                                     - View PDF - </a> &nbsp;&nbsp; 
	                            <a href="registrationPDF.php? ACTION=DOWNLOAD" 
                                    class="btn btn-primary"><i class="fa fa-download"></i>
                                     Download PDF</a> &nbsp;&nbsp;
	                        </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

</body>
</html>
<?php $pdo = null; ?>
