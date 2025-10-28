<?php
require_once('../includes/db_connect.php');
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=attendees_list.csv');

$output = fopen('php://output', 'w');
fputcsv($output, [
    'S/No', 'Name', 'Designation', 'Company', 'Email', 'Contact', 'Location', 'Check-In Time', 'Check-In Status', 'Certificate Status'
]);

$sql = "SELECT id, name, designation, company, email, contact, location, checkin_time, certificate_sent FROM hr_confluence_2025_registrations WHERE checkin_time IS NOT NULL ORDER BY checkin_time ASC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $sno = 1;
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $sno++,
            $row['name'],
            $row['designation'],
            $row['company'],
            $row['email'],
            $row['contact'],
            $row['location'],
            $row['checkin_time'],
            $row['checkin_time'] ? 'Checked In' : 'Not Checked In',
            $row['certificate_sent'] == 1 ? 'Sent' : 'Unsent'
        ]);
    }
}
fclose($output);
exit;
?>