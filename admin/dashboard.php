<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

$adminName = $_SESSION['admin'];

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Your database password
$dbname = "vana_test"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="../assets/images/favicon-removebg-preview.png" rel="icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            width: 280px;
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }
        .sidebar h4 {
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        .sidebar a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #adb5bd;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: white;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }
        .header {
            padding: 25px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }
        .welcome-message {
            padding: 30px;
            background-color: #e9ecef;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .welcome-message h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>Welcome, <?php echo htmlspecialchars($adminName); ?></h4>
        <a href="upload_event_photos.php">Upload Event Photos</a>
        <a href="manage_gallery.php">Manage Gallery</a>
        <a href="../join_community.php">Community Members List</a>
        <a href="collaborate_member_list.php">Collaborate List</a>
        <!-- <a href="event_register.php">Event Register list</a> -->
        <!--<a href="hrmeet2024_registration.php">HR Meet 2024 Register list</a>-->
        <!-- <a href="hr_confluence_2025_registration_list.php">HR Confluence 2025 Register List</a> -->
        <!-- <a href="hr_confluence_2025_attendees_list.php">HR Confluence 2025 Attendees List</a> -->
        <a href="hr_summit_2025_registration_list.php">HR Summit 2025 Registration List</a>
        <!-- <a href="send_confirmation.php">HR Festival 2025 Confirmation Emails</a>
        <a href="HRF_25_Certificate.php">HR Festival 2025 Certificates</a> -->
        <!--<a href="email_send.php">Confirmation Email</a>-->
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
        <div class="header">
            <h1>Admin Dashboard</h1>
        </div>
        <div class="welcome-message">
            <h2>Welcome to the Admin Dashboard!</h2>
            <p>Hello, <?php echo htmlspecialchars($adminName); ?>. You are now logged in. Use the sidebar to navigate through the dashboard.</p>
        </div>
        <!-- Page Content Goes Here -->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
