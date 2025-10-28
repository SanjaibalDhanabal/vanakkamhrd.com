<?php
// Include database connection
include("./includes/db_connect.php");

// Get the email or some identifier from the QR code (assuming it's passed via URL)
$email = $_GET['email'];

// Fetch the QR code status from the database
$sql = "SELECT qr_status FROM event_registration_covai_list WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($qr_status);
$stmt->fetch();
$stmt->close();

if ($qr_status === 'valid') {
    // QR code is valid, mark as scanned and show the content
    $update_sql = "UPDATE event_registration_covai_list SET qr_status = 'invalid' WHERE email = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->close();

    // Display the QR code content
    echo "<h1>Welcome, your registration is confirmed!</h1>";
    echo "<p>Your ticket is valid for one-time use only.</p>";
} else {
    // QR code is invalid
    echo "<h1>Invalid QR Code</h1>";
    echo "<p>This ticket has already been used or is no longer valid.</p>";
}

$conn->close();
?>
