<?php
// This file contains the database connection details and session destroy function.

// Datebase Login Details
$dbhost = 'localhost';
$db     = 'studentportal';
$dbuser = 'root';
$dbpass = 'Dev#njabulo221';
$chrset = 'utf8mb4';
$dbattr = "mysql:host=$dbhost;dbname=$db;charset=$chrset";
$opts = [
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES      => false,
];

try {
    $pdo = new PDO($dbattr, $dbuser, $dbpass, $opts);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Destroys a PHP Session
function destroySession() {
    $_SESSION = array();

    if(session_id() !== "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}

?>