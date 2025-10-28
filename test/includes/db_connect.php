<?php
$servername = "localhost";
$username = "vana_test";
$password = "Admin@123###"; // Your database password
$dbname = "vana_test"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
