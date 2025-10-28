<?php
// filepath: c:\xampp\htdocs\public_html\admin\collaborate_member_list.php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include("../includes/db_connect.php");

// Query for form submissions
$submissions_sql = "SELECT company, overview, website, name, contact, email, privacy, submission_date FROM collaborate_members ORDER BY submission_date DESC";
$submissions_result = $conn->query($submissions_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborate Members List</title>
    <link href="assets/images/favicon-removebg-preview.png" rel="icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1800px;
        }
        table {
            font-size: 13px;
            max-width: 1800px;
            margin: auto;
            background: #fff;
        }
        th, td {
            padding: 10px 8px;
            vertical-align: top;
        }
        th {
            text-align: center;
            background: #343a40;
            color: #fff;
        }
        td {
            text-align: left;
        }
        td, th {
            word-break: break-word;
            white-space: pre-line;
        }
        td:nth-child(1), th:nth-child(1), /* ID */
        td:nth-child(5), th:nth-child(5), /* Name */
        td:nth-child(6), th:nth-child(6), /* Contact */
        td:nth-child(7), th:nth-child(7), /* Email */
        td:nth-child(8), th:nth-child(8), /* Privacy */
        td:nth-child(9), th:nth-child(9)  /* Date */
        {
            text-align: center;
            /* vertical-align: middle; */
        }
        td:nth-child(3), th:nth-child(3) {
            width: 400px;
            max-width: 400px;
        }
        td:nth-child(2), th:nth-child(2) {
            width: 200px;
            max-width: 200px;
        }
        td:nth-child(4), th:nth-child(4) {
            width: 180px;
            max-width: 180px;
        }
        .table-responsive {
            margin-bottom: 40px;
        }
        @media (max-width: 1200px) {
            table { font-size: 11px; }
            td, th { padding: 6px 4px; }
        }
        @media (max-width: 900px) {
            table { font-size: 10px; }
            td, th { padding: 4px 2px; }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <h1 class="mb-4 text-center">Collaborate Members List</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Company</th>
                        <th>Overview</th>
                        <th>Website</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Privacy Agreed</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($submissions_result->num_rows > 0) {
                        $counter = 1; // Initialize the counter starting from 1
                        while ($row = $submissions_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $counter . "</td>"; // Use the custom counter instead of the database ID
                            echo "<td>" . htmlspecialchars($row["company"]) . "</td>";
                            echo "<td style='white-space: pre-line; text-align:left;'>" . nl2br(htmlspecialchars($row["overview"])) . "</td>";
                            echo "<td><a href='" . htmlspecialchars($row["website"]) . "' target='_blank'>" . htmlspecialchars($row["website"]) . "</a></td>";
                            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["contact"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                            echo "<td>" . ($row["privacy"] ? 'Yes' : 'No') . "</td>";
                            echo "<td>" . htmlspecialchars($row["submission_date"]) . "</td>";
                            echo "</tr>";
                            $counter++; // Increment the counter for the next row
                        }
                    } else {
                        echo "<tr><td colspan='9'>No submissions found</td></tr>";
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