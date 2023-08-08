<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_login_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
