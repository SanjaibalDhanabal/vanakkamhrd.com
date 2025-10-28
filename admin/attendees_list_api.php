<?php
// filepath: c:\xampp\htdocs\public_html\admin\attendees_list_api.php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'vana_test', 'Admin@123###', 'vana_test');
$sql = "SELECT id, name, designation, company, email, contact, location, checkin_time, certificate_sent, status FROM hr_confluence_2025_registrations WHERE checkin_time IS NOT NULL ORDER BY checkin_time ASC";
$res = $conn->query($sql);
$data = [];
while ($row = $res->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
$conn->close();
?>