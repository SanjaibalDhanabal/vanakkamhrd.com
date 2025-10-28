<?php
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "my_website";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $designation = $_POST['designation'];
    $linkedin = $_POST['linkedin'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO event_registration_list (name, email, contact, designation,  linkedin, company, location) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $contact, $designation, $linkedin, $company, $location);

    if ($stmt->execute()) {
        header("Location: sucessful_registration.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
