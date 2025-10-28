

<?php
include("../includes/db_connect.php");

// Define how many results you want per page
$results_per_page = 50;

// Count confirmed registrations
$count_query = "SELECT COUNT(id) AS confirmed FROM event_registration_bengaluru_list WHERE email_sent = 1";
$count_result = $conn->query($count_query);
$count_row = $count_result->fetch_assoc();
$confirmed_count = $count_row['confirmed'];

// Find out the number of total confirmed records
$sql = "SELECT COUNT(id) AS total FROM event_registration_bengaluru_list WHERE email_sent = 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_records = $row["total"];

// Calculate total pages
$total_pages = ceil($total_records / $results_per_page);

// Get the current page number
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting record
$start_from = ($current_page - 1) * $results_per_page;

// Fetch only confirmed registrations
$sql = "SELECT id, name, email, contact, designation, company, gender, location 
        FROM event_registration_bengaluru_list 
        WHERE email_sent = 1 
        LIMIT $start_from, $results_per_page";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Conference 2025 - Confirmed Registrations</title>
    <link href="assets/images/favicon-removebg-preview.png" rel="icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .pagination-info { text-align: right; margin-top: 10px; margin-bottom: 10px; }
        .pagination-controls { display: inline-flex; align-items: center; margin-left: 15px; }
        .pagination-controls a { color: #007bff; text-decoration: none; margin: 0 5px; }
        .pagination-controls a.disabled { color: #6c757d; pointer-events: none; }
    </style>
    <script>
        function selectAll(source) {
            var checkboxes = document.getElementsByName('selected_ids[]');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
 
</head>
<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-4">HR Conference 2025 - Confirmed Registrations</h2>
       
    </div>

    <!-- Display count of Confirmed -->
    <div class="alert alert-success text-center">
        <strong>Confirmed Registrations:</strong> <span class="text-success"><?php echo $confirmed_count; ?></span>
    </div>

    <!-- Pagination Info and Controls -->
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 text-right pagination-info">
            Showing <?php echo (($start_from + 1) . "-" . min($start_from + $results_per_page, $total_records)) . " of " . $total_records; ?>
            
            <div class="pagination-controls">
                <a href="?page=<?php echo max(1, $current_page - 1); ?>" class="<?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <a href="?page=<?php echo min($total_pages, $current_page + 1); ?>" class="<?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

<form action="process_selection_2025.php" method="post">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Status</th>
                <th><input type="checkbox" onclick="selectAll(this)"></th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Company</th>
                <th>Designation</th>
                <th>Gender</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $serial_number = $start_from + 1;
            while ($row = $result->fetch_assoc()): 
            ?>
            <tr>
    
                <td class="text-success text-center">✅ Confirmed</td>
               <td><input type="checkbox" name="selected_ids[]" value="<?= $row['id']; ?>"></td>
                <td><?= $serial_number++; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['contact']; ?></td>
                <td><?= $row['company']; ?></td>
                <td><?= $row['designation']; ?></td>
                <td><?= $row['gender']; ?></td>
                <td><?= $row['location']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <div class="text-center">
            <button type="submit" name="email_type" value="confirm" class="btn btn-success mb-4">Send Confirmation Emails</button>
        </div>
    </form> 
    
    

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>
</html>

<?php $conn->close(); ?>

