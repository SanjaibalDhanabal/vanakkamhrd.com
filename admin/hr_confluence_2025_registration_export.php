<?php
require_once('../includes/db_connect.php');
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=registration_list.csv');

$output = fopen('php://output', 'w');
fputcsv($output, [
    'S/No', 'Name', 'Designation', 'Company', 'Email', 'Contact', 'Location', 'How did you know?', 'Status', 'Registered At'
]);

$sql = "SELECT id, name, designation, company, email, contact, location, how_know, status, created_at FROM hr_confluence_2025_registrations ORDER BY created_at ASC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $row['id'],
            $row['name'],
            $row['designation'],
            $row['company'],
            $row['email'],
            $row['contact'],
            $row['location'],
            $row['how_know'],
            $row['status'],
            $row['created_at']
        ]);
    }
}
fclose($output);
exit;
?>