<?php
// filepath: c:\xampp\htdocs\public_html\admin\HRF_25_Certificate.php
include("../includes/db_connect.php");
require_once("../includes/fpdf/fpdf.php");

// PHPMailer from includes folder
require_once("PHPMailer/src/PHPMailer.php");
require_once("PHPMailer/src/SMTP.php");
require_once("PHPMailer/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;
$message = "";
$alertType = "success";

// Pagination setup
$perPage = 50;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $perPage;

// Count total users for pagination
$totalUsers = $conn->query("SELECT COUNT(*) as cnt FROM event_registers")->fetch_assoc()['cnt'];
$totalPages = ceil($totalUsers / $perPage);

// Count sent/unsent
$count_sent = $conn->query("SELECT COUNT(*) as sent FROM event_registers WHERE certificate_sent=1")->fetch_assoc()['sent'];
$count_unsent = $conn->query("SELECT COUNT(*) as unsent FROM event_registers WHERE certificate_sent!=1 OR certificate_sent IS NULL")->fetch_assoc()['unsent'];

// Certificate content block (use in all three places)
function generateCertificateContent($pdf, $user, $centerY = 70) {
    // Line 1: "This is awarded to"
    $pdf->SetFont('Arial','',18);
    $pdf->SetTextColor(60,60,60);
    $text1 = "This is awarded to";
    $w1 = $pdf->GetStringWidth($text1);
    $pdf->SetXY((297 - $w1) / 2, $centerY);
    $pdf->Cell($w1, 12, $text1, 0, 1, 'C');

    // Line 2: Name
    $pdf->SetFont('Helvetica','B',28);
    $pdf->SetTextColor(218,165,32); // Gold
    $w2 = $pdf->GetStringWidth($user['name']);
    $pdf->SetXY((297 - $w2) / 2, $centerY + 14);
    $pdf->Cell($w2, 14, $user['name'], 0, 1, 'C');

    // Line 3: Designation (if any)
    $nextY = $centerY + 32;
    if (!empty(trim($user['designation']))) {
        $pdf->SetFont('Arial','B',14);
        $pdf->SetTextColor(60,60,60);
        $w3 = $pdf->GetStringWidth($user['designation']);
        $pdf->SetXY((297 - $w3) / 2, $nextY);
        $pdf->Cell($w3, 8, $user['designation'], 0, 1, 'C');
        $nextY += 10;
    }

    // Line 4: Company (if any)
    if (!empty(trim($user['company']))) {
        $pdf->SetFont('Arial','B',14);
        $pdf->SetTextColor(60,60,60);
        $w4 = $pdf->GetStringWidth($user['company']);
        $pdf->SetXY((297 - $w4) / 2, $nextY);
        $pdf->Cell($w4, 8, $user['company'], 0, 1, 'C');
        $nextY += 10;
    }

    // Line 5-8: Merge into 2 lines
    $pdf->SetFont('Arial','',14);
    $pdf->SetTextColor(60,60,60);
    $line5 = "in recognition of your active participation in the India's Largest HR Festival 2025";
    $w5 = $pdf->GetStringWidth($line5);
    $pdf->SetXY((297 - $w5) / 2, $nextY);
    $pdf->Cell($w5, 10, $line5, 0, 1, 'C');
    $nextY += 10;

    $line6 = "held at Chennai Trade Centre, Chennai. Your presence contributed to the success of the event.";
    $w6 = $pdf->GetStringWidth($line6);
    $pdf->SetXY((297 - $w6) / 2, $nextY);
    $pdf->Cell($w6, 10, $line6, 0, 1, 'C');
}

// Bulk send certificates
if (isset($_POST['bulk_send']) && !empty($_POST['user_ids'])) {
    $sentCount = 0;
    foreach ($_POST['user_ids'] as $uid) {
        $stmt = $conn->prepare("SELECT id, name, designation, company, email, contact, certificate_sent FROM event_registers WHERE id=?");
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        if ($user && !$user['certificate_sent']) {
            $pdf = new FPDF('L', 'mm', 'A4');
            $pdf->AddPage();
            $pdf->Image('Images/C_P.png', 0, 0, 297, 210);
            generateCertificateContent($pdf, $user);

            $pdfFile = tempnam(sys_get_temp_dir(), 'cert_') . ".pdf";
            $pdf->Output('F', $pdfFile);
            $pdfdoc = file_get_contents($pdfFile);

            // Send email with PHPMailer
            $to = $user['email'];
            $subject = "Thank You for Participating - VHRD Festival 2025";
            $body = "Dear {$user['name']},<br><br>Thank you for being a part of the Vanakkam HRD Festival 2025 held at Chennai Trade Centre.
<br>Please find your Certificate of Participation attached as a token of our appreciation.<br><br>Looking forward to your continued support!
<br><br>Regards,<br>Vanakkam HRD";
            $filename = "Certificate_{$user['name']}.pdf";

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'support@vanakkamhrd.com';
                $mail->Password = 'muwvugubxbrcyiqi';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('support@vanakkamhrd.com', 'Vanakkam HRD');
                $mail->addAddress($to, $user['name']);
                $mail->Subject = $subject;
                $mail->isHTML(true);
                $mail->Body = $body;
                $mail->addStringAttachment($pdfdoc, $filename, 'base64', 'application/pdf');

                $mail->send();
                $conn->query("UPDATE event_registers SET certificate_sent=1 WHERE id={$user['id']}");
                $sentCount++;
            } catch (Exception $e) {
                // Optionally log $mail->ErrorInfo
            }
            unlink($pdfFile);
        }
    }
    $message = "$sentCount certificate(s) sent!";
    $alertType = "success";
}

// Single send
if ($action === 'send' && $id) {
    $stmt = $conn->prepare("SELECT id, name, designation, company, email, contact FROM event_registers WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user) {
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->Image('Images/C_P.png', 0, 0, 297, 210);
        generateCertificateContent($pdf, $user);

        $pdfFile = tempnam(sys_get_temp_dir(), 'cert_') . ".pdf";
        $pdf->Output('F', $pdfFile);
        $pdfdoc = file_get_contents($pdfFile);

        // Send email with PHPMailer
        $to = $user['email'];
        $subject = "Thank You for Participating – VHRD Festival 2025";
        $body = "Dear {$user['name']},<br><br>Thank you for being a part of the Vanakkam HRD Festival 2025 held at Chennai Trade Centre.
<br>Please find your Certificate of Participation attached as a token of our appreciation.
<br><br>Looking forward to your continued support!
<br><br>Regards,<br>Vanakkam HRD";
        $filename = "Certificate_{$user['name']}.pdf";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'support@vanakkamhrd.com';
            $mail->Password = 'muwvugubxbrcyiqi';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('support@vanakkamhrd.com', 'Vanakkam HRD');
            $mail->addAddress($to, $user['name']);
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $body;
            $mail->addStringAttachment($pdfdoc, $filename, 'base64', 'application/pdf');

            $mail->send();
            $conn->query("UPDATE event_registers SET certificate_sent=1 WHERE id={$user['id']}");
            $message = "Certificate sent to {$user['email']}!";
            $alertType = "success";
        } catch (Exception $e) {
            $message = "Failed to send certificate to {$user['email']}: {$mail->ErrorInfo}";
            $alertType = "danger";
        }
        unlink($pdfFile);
    }
}

// Preview
if ($action === 'preview' && $id) {
    $stmt = $conn->prepare("SELECT id, name, designation, company, contact FROM event_registers WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user) {
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->Image('Images/C_P.png', 0, 0, 297, 210);
        generateCertificateContent($pdf, $user);
        $pdf->Output('D', "Certificate_{$user['name']}.pdf");
        exit;
    }
}

if ($action === 'delete' && $id) {
    $conn->query("DELETE FROM event_registers WHERE id=$id");
    $message = "User deleted.";
    $alertType = "warning";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['bulk_send'])) {
    $name = $_POST['name'] ?? '';
    $designation = $_POST['designation'] ?? '';
    $company = $_POST['company'] ?? '';
    $email = $_POST['email'] ?? '';
    $contact = $_POST['contact'] ?? '';
    if ($action === 'edit' && $id) {
        $stmt = $conn->prepare("UPDATE event_registers SET name=?, designation=?, company=?, email=?, contact=? WHERE id=?");
        $stmt->bind_param("sssssi", $name, $designation, $company, $email, $contact, $id);
        $stmt->execute();
        $message = "User updated.";
        $alertType = "info";
    } else {
        $stmt = $conn->prepare("INSERT INTO event_registers (name, designation, company, email, contact) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $designation, $company, $email, $contact);
        $stmt->execute();
        $message = "User added.";
        $alertType = "success";
    }
}

// Fetch users for current page
$result = $conn->query("SELECT id, name, designation, company, email, contact, IFNULL(certificate_sent,0) as certificate_sent FROM event_registers ORDER BY id DESC LIMIT $offset, $perPage");

// For edit form
$editUser = null;
if ($action === 'edit' && $id) {
    $editUser = $conn->query("SELECT * FROM event_registers WHERE id=$id")->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate Email & CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background: #f8f9fa; }
        .container { background: #fff; border-radius: 10px; box-shadow: 0 2px 16px rgba(0,0,0,0.08); padding: 30px 30px 20px 30px; margin-top: 40px; }
        h2 { color: #12037f; margin-bottom: 30px; }
        .table th, .table td { vertical-align: middle !important; text-align: center; }
        .form-row > .col, .form-row > .col-auto { margin-bottom: 10px; }
        .btn-info, .btn-success, .btn-danger, .btn-primary, .btn-secondary { margin-right: 5px; }
        .alert { font-size: 1.1em; }
        .pagination { justify-content: center; }
        .action-cell {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 100%;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container">
    <h2 class="text-center">HR Festival 2025 - Certificate Management</h2>
    <div class="mb-3 text-center">
        <span class="badge badge-success" style="font-size:16px;">Certificate Sent: <?= $count_sent ?></span>
        <span class="badge badge-danger" style="font-size:16px;">Unsent: <?= $count_unsent ?></span>
    </div>
    <?php if ($message): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: '<?= $alertType ?>',
                    title: '<?= ucfirst($alertType) ?>',
                    text: '<?= addslashes($message) ?>',
                    timer: 2200,
                    showConfirmButton: false
                });
            });
        </script>
    <?php endif; ?>
    <form method="post" class="mb-4">
        <div class="form-row">
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="Name" value="<?= htmlspecialchars($editUser['name'] ?? '') ?>" required>
            </div>
            <div class="col">
                <input type="text" name="designation" class="form-control" placeholder="Designation" value="<?= htmlspecialchars($editUser['designation'] ?? '') ?>">
            </div>
            <div class="col">
                <input type="text" name="company" class="form-control" placeholder="Company" value="<?= htmlspecialchars($editUser['company'] ?? '') ?>">
            </div>
            <div class="col">
                <input type="email" name="email" class="form-control" placeholder="Email" value="<?= htmlspecialchars($editUser['email'] ?? '') ?>" required>
            </div>
            <div class="col">
                <input type="text" name="contact" class="form-control" placeholder="Contact" value="<?= htmlspecialchars($editUser['contact'] ?? '') ?>" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><?= $editUser ? 'Update' : 'Add' ?> User</button>
                <?php if ($editUser): ?>
                    <a href="HRF_25_Certificate.php" class="btn btn-secondary">Cancel</a>
                <?php endif; ?>
            </div>
        </div>
    </form>
    <form method="post">
    <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th><input type="checkbox" id="select_all"></th>
                <th>ID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Company</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Certificate Sent</th>
                <th>Certificate Preview</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td>
                    <?php if (!$row['certificate_sent']): ?>
                        <input type="checkbox" name="user_ids[]" value="<?= $row['id'] ?>" class="user-checkbox">
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['designation']) ?></td>
                <td><?= htmlspecialchars($row['company']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['contact']) ?></td>
                <td>
                    <?= $row['certificate_sent'] ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>' ?>
                </td>
                <td>
                    <a href="?action=preview&id=<?= $row['id'] ?>" class="btn btn-sm btn-info" target="_blank">Preview</a>
                </td>
                <td class="action-cell">
                    <a href="?action=send&id=<?= $row['id'] ?>" class="btn btn-sm btn-success" <?= $row['certificate_sent'] ? 'disabled' : '' ?>>Send Certificate</a>
                    <a href="?action=edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-info">Edit</a>
                    <a href="?action=delete&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button type="submit" name="bulk_send" class="btn btn-success" onclick="return confirm('Send certificates to selected users?')">Send Certificate to Selected</button>
        <span id="selectedCount" class="font-weight-bold">Selected: 0</span>
    </div>
    </form>
    <!-- Pagination -->
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
<script>
    // Select/Deselect all checkboxes
    document.getElementById('select_all').onclick = function() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"].user-checkbox');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
        updateSelectedCount();
    }
    // Update selected count
    function updateSelectedCount() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"].user-checkbox');
        var count = 0;
        for (var checkbox of checkboxes) {
            if (checkbox.checked) count++;
        }
        document.getElementById('selectedCount').innerText = "Selected: " + count;
    }
    // Add event listeners to checkboxes
    var userCheckboxes = document.querySelectorAll('input[type="checkbox"].user-checkbox');
    for (var checkbox of userCheckboxes) {
        checkbox.addEventListener('change', updateSelectedCount);
    }
    updateSelectedCount();
</script>
</body>
</html>