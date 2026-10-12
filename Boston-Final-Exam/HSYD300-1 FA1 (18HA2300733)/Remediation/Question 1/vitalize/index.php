<?php 

// <-- Main dashboard (view/add programs)
// Dashboard & Program List

include('data.php');
include('functions.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitalize Dashboard</title>
    <style>
        table, th, td { border: 1px solid black; padding: 10px; }
    </style>
</head>
<body>
    <h2>Vitalize - Gymnastics Program Management</h2>
    <a href = "add_program.php">Add New Program</a>
    <a href = "enrol.php">Enrol Gymnast</a>
    <a href = "attendance.php">Track Attendance</a>
    <br><br>
    <input type = "text" id = "search" placeholder = "Search Program..."
           onkeyup = "filterTable()">
    
    <table id = "programTable">
        <thead>
            <tr>
                <th>Name</th><th>Coach</th><th>Duration</th>
                <th>Skill Level</th><th>Enrolled</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($programs as $p): ?>
            <tr>
                <td><?= $p['name'] ?></td>
                <td><?= $p['coach'] ?></td>
                <td><?= $p['duration'] ?></td>
                <td><?= $p['skill_level'] ?></td>
                <td><?= count(array_filter($enrolments, fn($e) 
                       => $e['program_id'] == $p['id'])) ?></td>
            </tr>
        <?php endforeach; ?>
        <tbody>
        </table>

        <script>
            function filterTable() {
                const filter = document.getElementByID("search").value.toUpperCase();
                const rows = document.querySelector("#programTable tbody").rows;

                for(let i = 0; i < rows.length; i++) {
                    let name = rows[i].cells[0].textContent.toUpperCase();
                    rows[i].style.display = name.includes(filter) ? "": "none";
                }
            }
        </script>
</body>
</html>