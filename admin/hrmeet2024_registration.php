<?php
// Include database connection file
include("../includes/db_connect.php");

// Define how many results you want per page
$results_per_page = 50;

// Find out the number of records
$sql = "SELECT COUNT(id) AS total FROM event_registration_covai_list";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_records = $row["total"];

// Calculate total pages
$total_pages = ceil($total_records / $results_per_page);

// Find out the current page number (from GET request)
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1; // Default is the first page
}

// Calculate the starting record for the current page
$start_from = ($current_page - 1) * $results_per_page;

// SQL query to fetch the selected records for the current page
$sql = "SELECT id, name, email, contact, designation, company, location FROM event_registration_covai_list LIMIT $start_from, $results_per_page";
$result = $conn->query($sql);

// Check if query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Meet 2024 - Registration List</title>
    <link href="assets/images/favicon-removebg-preview.png" rel="icon">
    <!-- Include Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .select-all-checkbox {
            cursor: pointer;
        }
        .pagination-info {
            text-align: right;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .pagination-controls {
            display: inline-flex;
            align-items: center;
            margin-left: 15px;
        }
        .pagination-controls a {
            color: #007bff;
            text-decoration: none;
            margin: 0 5px;
        }
        .pagination-controls a.disabled {
            color: #6c757d; /* Gray color for disabled */
            pointer-events: none; /* Disable clicks */
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="my-4">HR Meet 2024 - Registration List</h2>

        <!-- Pagination Info and Controls -->
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right pagination-info">
                <?php echo (($start_from + 1) . "-" . min($start_from + $results_per_page, $total_records)) . " of " . $total_records; ?>
                
                <div class="pagination-controls">
                    <!-- Always show Previous icon, but disable it on the first page -->
                    <a href="?page=<?php echo max(1, $current_page - 1); ?>" class="<?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                        <i class="fas fa-arrow-left"></i>
                    </a>

                    <!-- Always show Next icon, but disable it on the last page -->
                    <a href="?page=<?php echo min($total_pages, $current_page + 1); ?>" class="<?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Designation</th>
                        <th>Company</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $counter = $start_from + 1; // Initialize counter based on page
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                           
                            echo "<td>" . $counter . "</td>"; // Display counter value as ID
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["contact"] . "</td>";
                            echo "<td>" . $row["designation"] . "</td>";
                            echo "<td>" . $row["company"] . "</td>";
                            echo "<td>" . $row["location"] . "</td>";
                            echo "</tr>";
                            $counter++; // Increment counter after each row
                        }
                    } else {
                        echo "<tr><td colspan='8'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            </div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>