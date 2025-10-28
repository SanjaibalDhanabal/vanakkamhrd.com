<?php
// Database configuration
$host = 'localhost';
$dbname = 'vana_test';
$username = 'vana_test';
$password = 'Admin@123###';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch all records
    $stmt = $pdo->prepare("SELECT * FROM event_registers");
    $stmt->execute();
    $eventRegisters = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Handle connection error
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Event Registrations</title>
    <!-- You can include Bootstrap for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Event Registration List</h2>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Company</th>
                <th>Designation</th>
                <th>Options</th>
                <th>Order ID</th>
                <th>Photo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventRegisters as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['contact']) ?></td>
                    <td><?= htmlspecialchars($row['company']) ?></td>
                    <td><?= htmlspecialchars($row['designation']) ?></td>
                    <td><?= htmlspecialchars($row['options']) ?></td>
                    <td><?= htmlspecialchars($row['order_id']) ?></td>
                    <td>
                        <?php if (!empty($row['photo']) && file_exists('event_register/'.$row['photo'])): ?>
                            <img src="event_register/<?= htmlspecialchars($row['photo']) ?>" alt="Photo" width="100">
                        <?php else: ?>
                            No photo
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Optional: Add Bootstrap JS for any additional functionality -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
