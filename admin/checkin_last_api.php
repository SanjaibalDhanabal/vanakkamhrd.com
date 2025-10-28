<?php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'vana_test', 'Admin@123###', 'vana_test');
$res = $conn->query("SELECT name, status, checkin_time FROM hr_confluence_2025_registrations WHERE checkin_time IS NOT NULL ORDER BY checkin_time DESC LIMIT 1");
if ($row = $res->fetch_assoc()) {
    echo json_encode([
        'name' => $row['name'],
        'status' => ucfirst($row['status']),
        'checkin_time' => date('d-m-Y H:i:s', strtotime($row['checkin_time']))
    ]);
} else {
    echo json_encode([]);
}
$conn->close();
?>