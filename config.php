<?php
$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "php";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("the connection failed: " . $conn->connect_error);
}
?>
