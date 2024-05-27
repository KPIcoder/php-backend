<?php
$servername = "localhost";
$username = "Ihor";
$password = "Qwerty12345";
$dbname = "backend";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>