<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


$host = "sql213.infinityfree.com"; 
$user = "if0_38934762";            
$pass = "1q6RjxZiQkTM";              
$db   = "if0_38934762_Natati";     


$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
