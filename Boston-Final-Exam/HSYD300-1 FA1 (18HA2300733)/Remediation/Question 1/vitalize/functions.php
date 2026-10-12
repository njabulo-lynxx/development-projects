<?php

// <-- Core logic (add/edit/delete/etc)
// Reusable Logic

function validateProgram($data) {
    return !empty($data['name']) && is_numeric($data['duration'])
        && in_array($data['skill_level'], ['Beginner', 'Intermediate', 'Advanced']);
}

function addProgram($programs, $data) {
    $programs[] = [
        'id' => uniqid(),
        'name' => $data['name'],
        'description' => $data['description'],
        'coach' => $data['coach'],
        'contact' => $data['contact'],
        'duration' => $data['duration'],
        'skill_level' => $data['skill_level'],
    ];
}

function enrolGymnast($enrolments, $data) {
    $enrolments[] = [
        'program_id' => $data['program_id'],
        'name' => $data['name'],
        'age' => $data['age'],
        'experience' => $data['experience'],
    ];
}

function trackAttendance($attendance, $program_id, $gymnast_name, 
                       $session_date, $present) {
    
    $attendance[] = [
        'program_id' => $program_id,
        'gymnast' => $gymnast_name,
        'date' => $session_date,
        'present' => $present,
    ];
}

function calculateProgress($attendance, $program_id, $gymnast_name) {

    $sessions = array_filter($attendance, function($entry) 
                use ($program_id, $gymnast_name){
        return $entry['program_id'] == $program_id && 
               $entry['gymnast'] == $gymnast_name;
    });

    $attended = array_filter($sessions, fn($s) => $s['present']);
    return count($sessions) ? (count($attended) / count($sessions)) * 100 : 0;
}

?>