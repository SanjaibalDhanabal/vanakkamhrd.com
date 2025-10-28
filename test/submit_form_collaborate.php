<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_website";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are set
    $company = isset($_POST['company']) ? $_POST['company'] : '';
    $overview = isset($_POST['overview']) ? $_POST['overview'] : '';
    $website = isset($_POST['website']) ? $_POST['website'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $privacy = isset($_POST['privacy']) ? 1 : 0;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO collaborate_members (company, overview, website, name, contact, email, privacy) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $company, $overview, $website, $name, $contact, $email, $privacy);

    // Execute statement
    if ($stmt->execute()) {
        header("Location: sucessful_registration.php");
        exit();
    } else {
        echo "Error: " . $stmt->error . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>



