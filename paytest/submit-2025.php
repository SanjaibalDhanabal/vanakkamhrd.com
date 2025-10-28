<?php
session_start();
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "my_website";

// Connect to database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = sanitize($_POST["name"]);
    $email = sanitize($_POST["email"]);
    $contact = sanitize($_POST["contact"]);
    $company = sanitize($_POST["company"]);
    $designation = sanitize($_POST["designation"]);
    $options = sanitize($_POST["options"]);

    // ✅ Fix: Properly Handle Checkbox Value
    $social_media_follow = isset($_POST["socialMediaCheck"]) ? 1 : 0;

    // Check if email already exists
    $emailCheckQuery = "SELECT email FROM registrations_2025_hr WHERE email = ?";
    $stmt = $conn->prepare($emailCheckQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "This email is already registered!";
        header("Location: error.php"); // Redirect to an error page
        exit();
    }
    $stmt->close();

    // File upload directory
    $uploadDir = "uploads/";

    // Handle photo upload
    $photo = $_FILES["photo"]["name"];
    $photoTmp = $_FILES["photo"]["tmp_name"];
    $photoPath = $uploadDir . time() . "_" . basename($photo);
    move_uploaded_file($photoTmp, $photoPath);

    // Prepare SQL query to insert data
    $stmt = $conn->prepare("INSERT INTO registrations_2025_hr 
        (name, email, contact, company, designation, options, photo) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssss", 
        $name, $email, $contact, $company, $designation, $options, $photoPath
    );

    // Execute the query
    if ($stmt->execute()) {
        // ✅ Store user data in session for poster generation
        $_SESSION['registered_user'] = [
            "name" => $name,
            "designation" => $designation,
            "company" => $company,
            "photo" => $photoPath
        ];

        // ✅ Redirect to poster page instead of success page
        header("Location: poster_2025.php"); 
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location: error.php"); // Redirect to an error page
        exit();
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    $_SESSION['error'] = "Invalid request!";
    header("Location: error.php");
    exit();
}
?>



