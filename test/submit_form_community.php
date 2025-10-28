<?php
// Database credentials
$host = 'localhost'; // Replace with your host
$dbname = 'my_website'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $designation = $_POST['designation'];
    $company = $_POST['company'];
    $linkedin = $_POST['linkedin'];
    $location = $_POST['location'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imagePath = 'uploads/' . basename($imageName);

        // Move the uploaded file to the 'uploads' directory
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            // Prepare SQL statement
            $sql = "INSERT INTO community_members (name, email, contact, designation, company, linkedin, image, location)
                    VALUES (:name, :email, :contact, :designation, :company, :linkedin, :image, :location)";

            $stmt = $pdo->prepare($sql);

            // Bind parameters and execute the statement
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':contact', $contact);
            $stmt->bindParam(':designation', $designation);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':linkedin', $linkedin);
            $stmt->bindParam(':image', $imagePath);
            $stmt->bindParam(':location', $location);

            if ($stmt->execute()) {
                header("Location: sucessful_registration.php");
        exit();
            } else {
                echo "Error: Could not execute the query.";
            }
        } else {
            echo "Error: Failed to upload image.";
        }
    } else {
        echo "Error: No image uploaded or upload error.";
    }
} else {
    echo "Error: Invalid request method.";
}
?>
