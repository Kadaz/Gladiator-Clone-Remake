<?php
$host = 'localhost';
$user = 'root';
$pass = '3227';
$dbname = 'gladiatus';

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>