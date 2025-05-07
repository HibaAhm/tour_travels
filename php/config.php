<?php
// php/config.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$port = 3306;
$user = "root";
$pass = "Natu1225@5";
$db   = "travel_site";

$conn = new mysqli($host, $user, $pass, $db, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
