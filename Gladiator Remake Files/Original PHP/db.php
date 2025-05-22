<?php
$host = "localhost";
$user = "root";
$password = "3227";
$database = "gladiatus";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>