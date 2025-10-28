<?php

require_once('../includes/db_connect.php');

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=hr_summit_2025_registrations.csv');

$output = fopen('php://output', 'w');
fputcsv($output, [
    'ID', 'Name', 'Email', 'Contact', 'Company', 'Designation', 'Options', 'Order ID', 'Payment Status', 'Created Time', 'Email Sent', 'Certificate Sent'
]);

$sql = "SELECT id, name, email, contact, company, designation, options, order_id, payment_status, created_time, email_sent, certificate_sent FROM event_registers ORDER BY id ASC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['id'],
        $row['name'],
        $row['email'],
        $row['contact'],
        $row['company'],
        $row['designation'],
        $row['options'],
        $row['order_id'],
        $row['payment_status'] == 1 ? 'Paid' : 'Unpaid',
        $row['created_time'],
        $row['email_sent'] ? 'Yes' : 'No',
        $row['certificate_sent'] ? 'Yes' : 'No'
    ]);
}
fclose($output);
exit;
?>