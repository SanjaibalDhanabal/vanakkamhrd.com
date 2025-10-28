<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
include('../includes/db_connect.php');

// Query for community members
$members_sql = "SELECT id, name, email, contact, designation, company, linkedin, image, location, reg_date FROM community_members";
$members_result = $conn->query($members_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Members List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Community Members List</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Designation</th>
                        <th>Company</th>
                        <th>LinkedIn</th>
                        <th>Image</th>
                        <th>Location</th>
                        <th>Registration Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($members_result->num_rows > 0) {
                        while ($row = $members_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["contact"] . "</td>";
                            echo "<td>" . $row["designation"] . "</td>";
                            echo "<td>" . $row["company"] . "</td>";
                            echo "<td><a href='" . htmlspecialchars($row["linkedin"]) . "' target='_blank'>LinkedIn</a></td>";
                            echo "<td>";
                            $imagePath = '../uploads/community_images/' . htmlspecialchars($row["image"]);
                            if (!empty($row["image"]) && file_exists($imagePath)) {
                                echo "<img src='" . $imagePath . "' alt='Member Image'>";
                            } else {
                                echo "<img src='../uploads/default-image.jpg' alt='Default Image'>";
                            }
                            echo "</td>";
                            echo "<td>" . $row["location"] . "</td>";
                            echo "<td>" . $row["reg_date"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
