<?php
// filepath: c:\xampp\htdocs\public_html\admin\hr_confluence_2025_attendees_list.php

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
require_once('../includes/fpdf/fpdf.php');
require_once('../includes/db_connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Certificate PDF generator
function generateCertificatePDF($name, $designation, $company) {
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->Image(__DIR__ . '/../assets/images/Certificates/Hr_Confluence_2025_CBE.png', 0, 0, 297, 210);

    // Stylish gold name
    $pdf->AddFont('AspireDemibold-YaaO','','AspireDemibold-YaaO.php');
    $pdf->SetFont('AspireDemibold-YaaO', '', 32);
    $pdf->SetTextColor(218, 165, 32);
    $pdf->SetXY(0, 89);
    $pdf->Cell(297, 14, $name, 0, 1, 'C');

    // Designation
    $pdf->AddFont('Lora-BoldItalic','','Lora-BoldItalic.php');
    $pdf->SetFont('Lora-BoldItalic', '', 16);
    $pdf->SetTextColor(40, 40, 40);
    $pdf->SetXY(0, 105);
    $pdf->Cell(297, 10, $designation, 0, 1, 'C');

    // Company
    $pdf->AddFont('Merriweather-Regular','','Merriweather-Regular.php');
    $pdf->SetFont('Merriweather-Regular', '', 14);
    $pdf->SetTextColor(40, 40, 40);
    $pdf->SetXY(0, 113);
    $pdf->Cell(297, 10, $company, 0, 1, 'C');

    $file = tempnam(sys_get_temp_dir(), 'cert_') . '.pdf';
    $pdf->Output('F', $file);
    return $file;
}

// PHPMailer SMTP function with PDF attachment
function sendCertificate($to, $name, $designation, $company) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'support@vanakkamhrd.com';
        $mail->Password   = 'muwvugubxbrcyiqi'; // Use app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->setFrom('support@vanakkamhrd.com', 'HR Confluence 2025');
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = "Thank You for Participating – VHRD HR Confluence 2025";
        $mail->Body    = "
            <p>Dear $name,</p>
            <p>Thank you for being a part of the Vanakkam HRD HR Confluence 2025 held at Zone by the Park Hotel, Coimbatore.</p>
            <p>Best regards,<br>Vanakkam HRD Team</p>
        ";
        $pdfFile = generateCertificatePDF($name, $designation, $company);
        $mail->addAttachment($pdfFile, 'Certificate_HR_Confluence_2025.pdf');
        $mail->send();
        unlink($pdfFile);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Mark certificate sent in DB
if (isset($_GET['send_cert']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $res = $conn->query("SELECT name, email, designation, company FROM hr_confluence_2025_registrations WHERE id=$id AND checkin_time IS NOT NULL");
    if ($row = $res->fetch_assoc()) {
        if (sendCertificate($row['email'], $row['name'], $row['designation'], $row['company'])) {
            $conn->query("UPDATE hr_confluence_2025_registrations SET certificate_sent=1 WHERE id=$id");
        }
        header("Location: hr_confluence_2025_attendees_list.php?cert=sent");
        exit;
    }
}

// Bulk send certificates (selected)
if (isset($_POST['bulk_send_selected']) && isset($_POST['selected_ids'])) {
    $ids = $_POST['selected_ids'];
    $sent = 0;
    foreach ($ids as $id) {
        $id = intval($id);
        $res = $conn->query("SELECT name, email, designation, company FROM hr_confluence_2025_registrations WHERE id=$id AND checkin_time IS NOT NULL AND (certificate_sent IS NULL OR certificate_sent=0)");
        if ($row = $res->fetch_assoc()) {
            if (sendCertificate($row['email'], $row['name'], $row['designation'], $row['company'])) {
                $conn->query("UPDATE hr_confluence_2025_registrations SET certificate_sent=1 WHERE id=$id");
                $sent++;
            }
        }
    }
    header("Location: hr_confluence_2025_attendees_list.php?bulk_sent=$sent");
    exit;
}

// Bulk send certificates (all unsent)
if (isset($_POST['bulk_send'])) {
    $sql_bulk = "SELECT id, name, email, designation, company FROM hr_confluence_2025_registrations WHERE checkin_time IS NOT NULL AND (certificate_sent IS NULL OR certificate_sent=0)";
    $res_bulk = $conn->query($sql_bulk);
    $sent = 0;
    while ($row = $res_bulk->fetch_assoc()) {
        if (sendCertificate($row['email'], $row['name'], $row['designation'], $row['company'])) {
            $conn->query("UPDATE hr_confluence_2025_registrations SET certificate_sent=1 WHERE id={$row['id']}");
            $sent++;
        }
    }
    header("Location: hr_confluence_2025_attendees_list.php?bulk_sent=$sent");
    exit;
}

// Pagination setup
$limit = 50; // Number of records per page
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Get total checked-in attendees for pagination
$count_sql = "SELECT COUNT(*) as total FROM hr_confluence_2025_registrations WHERE checkin_time IS NOT NULL";
$count_res = $conn->query($count_sql);
$total_attendees = ($count_res && $count_row = $count_res->fetch_assoc()) ? intval($count_row['total']) : 0;
$total_pages = ceil($total_attendees / $limit);

// Fetch only checked-in attendees for current page
$sql = "SELECT id, name, designation, company, email, contact, location, checkin_time, certificate_sent, status FROM hr_confluence_2025_registrations WHERE checkin_time IS NOT NULL ORDER BY checkin_time ASC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Stats
$total = 0;
$sent = 0;
$unsent = 0;
$attendees = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $attendees[] = $row;
        $total++;
        if (!empty($row['certificate_sent'])) $sent++;
        else $unsent++;
    }
}

// For stats (all pages)
$stats_sql = "SELECT COUNT(*) as total, SUM(certificate_sent) as sent FROM hr_confluence_2025_registrations WHERE checkin_time IS NOT NULL";
$stats_res = $conn->query($stats_sql);
$stats_row = $stats_res->fetch_assoc();
$stats_total = intval($stats_row['total']);
$stats_sent = intval($stats_row['sent']);
$stats_unsent = $stats_total - $stats_sent;
?>

<!DOCTYPE html>
<html>
<head>
    <title>HR Confluence 2025 - Attendees List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
    <style>
        body { background: #f8f9fa; }
        .container { margin-top: 40px; }
        .table thead { background: #1a237e; color: #fff; }
        .table tbody tr:nth-child(even) { background: #f1f1f1; }
        h2 { color: #1a237e; margin-bottom: 24px; }
        .table-responsive { min-width: 1000px; overflow-x: auto; }
        .table { font-size: 1rem; min-width: 1000px; }
        th, td { padding: 0.85rem 1.1rem !important; }
        .container { max-width: 100vw; overflow-x: auto; }
        .table td, .table th { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 220px; }
        .table-responsive { overflow-x: auto; }
        .stats-box { display: flex; gap: 2rem; justify-content: center; margin-bottom: 1.5rem; }
        .stats-item { background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #eee; padding: 1rem 2rem; text-align: center; }
        .stats-item h4 { margin: 0 0 0.5rem 0; font-size: 1.1rem; color: #1a237e; }
        .stats-item .count { font-size: 1.5rem; font-weight: bold; }
        .bulk-btn { margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem; }
        .pagination { justify-content: center; }
        .checkin-alert {
            margin-bottom: 18px;
            min-width: 320px;
            max-width: 420px;
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 18px;
            border-radius: 8px;
            font-size: 1.08rem;
            box-shadow: 0 2px 8px #eee;
            justify-content: center;
        }
        .checkin-alert .fa-user-check {
            font-size: 1.5rem;
            margin-right: 10px;
        }
        .checkin-alert .checkin-time {
            font-size: 0.98rem;
            color: #555;
            margin-left: 8px;
        }
        .checkin-alert .status {
            font-weight: bold;
            margin-right: 8px;
        }
        .checkin-approved { background: #e3fcec; border-left: 6px solid #28a745; color: #1a237e; }
        .checkin-pending { background: #fffbe6; border-left: 6px solid #ffc107; color: #856404; }
        .checkin-rejected { background: #fdecea; border-left: 6px solid #dc3545; color: #721c24; }
    </style>
</head>
<body>
<div class="container position-relative">
    <h2 style="text-align: center;">Checked-In Attendees - HR Confluence 2025</h2>
    <div class="stats-box">
        <div class="stats-item">
            <h4>Total Attendees</h4>
            <div class="count"><?= $stats_total ?></div>
        </div>
        <div class="stats-item">
            <h4>Certificates Sent</h4>
            <div class="count text-success"><?= $stats_sent ?></div>
        </div>
        <div class="stats-item">
            <h4>Unsent</h4>
            <div class="count text-danger"><?= $stats_unsent ?></div>
        </div>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <div id="checkinAlertArea" style="width:100%;max-width:420px;"></div>
    </div>
    <?php if (isset($_GET['cert']) && $_GET['cert'] == 'sent'): ?>
        <script>
        Swal.fire({icon: 'success', title: 'Certificate Sent!', showConfirmButton: false, timer: 1500});
        </script>
    <?php endif; ?>
    <?php if (isset($_GET['bulk_sent'])): ?>
        <script>
        Swal.fire({icon: 'success', title: 'Bulk Certificates Sent!', text: 'Certificates sent: <?= intval($_GET['bulk_sent']) ?>', showConfirmButton: false, timer: 2000});
        </script>
    <?php endif; ?>
    <div class="d-flex mb-2 gap-2 align-items-center">
        <input type="text" class="form-control w-auto" style="max-width:300px;" id="globalSearchInput" placeholder="Search..." onkeyup="globalSearchTable()">
        <a class="btn btn-outline-success ms-2" href="hr_confluence_2025_attendees_export.php">
            <i class="fa fa-file-excel"></i> Export to Excel
        </a>
        <!-- <button class="btn btn-outline-danger ms-2" onclick="exportTableToPDF()">
            <i class="fa fa-file-pdf"></i> Export to PDF
        </button> -->
    </div>
    <div class="table-responsive">
        <form method="post" id="bulkForm">
        <table class="table table-bordered table-hover align-middle" id="attendeeTable">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)"></th>
                    <th>#</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Location</th>
                    <th>Check-In Time</th>
                    <th>Check-In Status</th>
                    <th>Certificate Status</th>
                    <th>Send Certificate</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table body will be filled by AJAX -->
            </tbody>
        </table>
        <div class="bulk-btn">
            <button type="submit" name="bulk_send" class="btn btn-success">
                <i class="fa fa-paper-plane"></i> Send Certificates to All Unsent
            </button>
            <button type="submit" name="bulk_send_selected" class="btn btn-primary" onclick="return confirm('Send certificates to selected attendees?');">
                <i class="fa fa-envelope"></i> Send Selected
            </button>
        </div>
        </form>
        <!-- Pagination -->
        <nav>
            <ul class="pagination mt-4">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $page-1 ?>">Previous</a></li>
                <?php endif; ?>
                <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                    <li class="page-item <?= ($p == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $p ?>"><?= $p ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $page+1 ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<script>
let attendeesData = [];

// Global search
function globalSearchTable() {
    var input = document.getElementById('globalSearchInput');
    var filter = input.value.toUpperCase();
    var table = document.getElementById("attendeeTable");
    var tr = table.getElementsByTagName("tr");
    for (var i = 1; i < tr.length; i++) {
        var tds = tr[i].getElementsByTagName("td");
        var found = false;
        for (var j = 2; j < tds.length - 2; j++) {
            if (tds[j]) {
                var txtValue = tds[j].textContent || tds[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }
        tr[i].style.display = found ? "" : "none";
    }
}

// Select all checkboxes
function toggleSelectAll(source) {
    var checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
    }
}

// Export to CSV (works in Excel)
function exportTableToCSV(filename = 'attendees_list.csv') {
    if (!attendeesData.length) {
        alert('No data to export!');
        return;
    }
    let csv = '';
    // Table headers
    csv += [
        'S.No', 'Name', 'Designation', 'Company', 'Email', 'Contact', 'Location', 'Check-In Time', 'Check-In Status', 'Certificate Status'
    ].join(",") + '\n';

    // Table rows
    attendeesData.forEach(function(row, idx) {
        csv += [
            idx + 1,
            row.name,
            row.designation,
            row.company,
            row.email,
            row.contact,
            row.location,
            row.checkin_time,
            row.checkin_time ? 'Checked In' : 'Not Checked In',
            row.certificate_sent == 1 ? 'Sent' : 'Unsent'
        ].map(val => `"${(val ?? '').toString().replace(/"/g, '""')}"`).join(",") + '\n';
    });

    // Download as .csv
    let blob = new Blob([csv], { type: 'text/csv' });
    let link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Export to PDF
function exportTableToPDF() {
    const { jsPDF } = window.jspdf;
    var doc = new jsPDF('l', 'pt', 'a4');
    doc.text("Checked-In Attendees - HR Confluence 2025", 40, 40);
    var res = doc.autoTableHtmlToJson(document.getElementById("attendeeTable"));
    doc.autoTable({
        head: [res.columns.map(col => col.title)],
        body: res.data,
        startY: 60,
        styles: { fontSize: 8 }
    });
    doc.save("attendees_list.pdf");
}

// Real-time check-in alert (AJAX polling with slide down animation)
let lastCheckinName = '';
function fetchCheckinAlert() {
    fetch('checkin_last_api.php')
        .then(response => response.json())
        .then(data => {
            const area = document.getElementById('checkinAlertArea');
            if (data && data.name) {
                let status = data.status.toLowerCase();
                let alertClass = 'checkin-alert checkin-pending';
                if (status === 'approved') alertClass = 'checkin-alert checkin-approved';
                else if (status === 'rejected') alertClass = 'checkin-alert checkin-rejected';
                let html = `
                    <div class="${alertClass}" id="checkinCard" style="display:none;">
                        <i class="fa fa-user-check"></i>
                        <span class="status">${data.status}</span>
                        <span>${data.name}</span>
                        <span class="checkin-time">${data.checkin_time}</span>
                    </div>
                `;
                // Only animate if new check-in
                if (lastCheckinName !== data.name) {
                    area.innerHTML = html;
                    $("#checkinCard").slideDown(400);
                    lastCheckinName = data.name;
                } else {
                    // Just update without animation
                    area.innerHTML = html;
                    document.getElementById('checkinCard').style.display = 'block';
                }
            } else {
                area.innerHTML = '';
                lastCheckinName = '';
            }
        });
}
fetchCheckinAlert();
setInterval(fetchCheckinAlert, 5000); // Poll every 5 seconds

// Real-time attendees table (AJAX polling)
function renderAttendeesTable(data) {
    attendeesData = data; // Store for export
    let tbody = '';
    let i = 1;
    data.forEach(function(row) {
        tbody += `<tr>
            <td>${row.certificate_sent == 0 ? `<input type="checkbox" name="selected_ids[]" value="${row.id}">` : ''}</td>
            <td>${i++}</td>
            <td>${row.name}</td>
            <td>${row.designation}</td>
            <td>${row.company}</td>
            <td>${row.email}</td>
            <td>${row.contact}</td>
            <td>${row.location}</td>
            <td>${row.checkin_time}</td>
            <td>${row.checkin_time ? `<span class="badge bg-success">Checked In</span>` : `<span class="badge bg-secondary">Not Checked In</span>`}</td>
            <td>${row.certificate_sent == 1 ? `<span class="badge bg-success">Sent</span>` : `<span class="badge bg-danger">Unsent</span>`}</td>
            <td>${row.certificate_sent == 0 ? `<a href="?send_cert=1&id=${row.id}" class="btn btn-primary btn-sm" title="Send Certificate"><i class="fa fa-envelope"></i> Send</a>` : `<button class="btn btn-secondary btn-sm" disabled>Sent</button>`}</td>
        </tr>`;
    });
    document.querySelector('#attendeeTable tbody').innerHTML = tbody;
}

function fetchAttendeesTable() {
    fetch('attendees_list_api.php')
        .then(response => response.json())
        .then(data => {
            renderAttendeesTable(data);
        });
}
fetchAttendeesTable();
setInterval(fetchAttendeesTable, 5000); // Poll every 5 seconds
</script>
</body>
</html>
<?php
$conn->close();
?>