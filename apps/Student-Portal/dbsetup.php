<?php 
/*This file sets up the database tables
 * It is intended to be run once
 * I recommend you create the database manually and then run this script to create the tables
 */ 

// Create DATABASE studentportal;

require_once 'dbconn.php';
// Stores the administrators password and username
$pdo->query('CREATE TABLE IF NOT EXISTS adminAuth(
      admin VARCHAR(50),
      pass VARCHAR(255),
      INDEX(admin(6))
)');

// Stores the students password and username
$pdo->query('CREATE TABLE IF NOT EXISTS studentAuth(
      student VARCHAR(50),
      pass VARCHAR(255),
      INDEX(student(6))
)');

// Stores students info
$pdo->query('CREATE TABLE IF NOT EXISTS studentInfo(
      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      full_name VARCHAR(50),
      student_id VARCHAR(16),
      email VARCHAR(50),
      dob DATE,
      course VARCHAR(50),
      year INT,
      enrolment_date DATE,
      academic_status VARCHAR(20),
      INDEX(full_name(6))
)');

// Adds an admin for screenshot purposes
$pdo->query('INSERT INTO `adminauth`(`admin`, `pass`) 
VALUES ("Lynx",$2y$10$dHidFl1an46ZTbPR4gGfMuivTPxCrMzkoAoeF1qiaAJisXRp0Hysq
)');

?>       