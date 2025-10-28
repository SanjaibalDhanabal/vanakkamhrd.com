<?php
// filepath: c:\xampp\htdocs\public_html\admin\send_confirmation.php
include("../includes/db_connect.php");
include("../includes/mail_function.php");

// Pagination and search setup
$results_per_page = 100;

// --- Search logic ---
$search = '';
$search_sql = '';
if (isset($_GET['search']) && trim($_GET['search']) !== '') {
    $search = trim($_GET['search']);
    $search_sql = "WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR contact LIKE '%$search%'";
}

// Get all column names dynamically
$columns_result = $conn->query("SHOW COLUMNS FROM event_registers");
$columns = [];
while ($col = $columns_result->fetch_assoc()) {
    $columns[] = $col['Field'];
}

// Update total count and result queries to use $search_sql
$count_result = $conn->query("SELECT COUNT(*) AS total FROM event_registers $search_sql");
$row_count = $count_result->fetch_assoc();
$total_results = $row_count['total'];
$total_pages = ceil($total_results / $results_per_page);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$start_from = ($page - 1) * $results_per_page;

// Get total sent and unsent counts (not filtered by search)
$count_sent = $conn->query("SELECT COUNT(*) AS sent FROM event_registers WHERE email_sent=1")->fetch_assoc()['sent'];
$count_unsent = $conn->query("SELECT COUNT(*) AS unsent FROM event_registers WHERE email_sent!=1 OR email_sent IS NULL")->fetch_assoc()['unsent'];

$emailSent = false;

// Handle form submission to send emails
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_ids'])) {
    $ids = $_POST['user_ids'];
    foreach ($ids as $id) {
        $query = "SELECT * FROM event_registers WHERE id = '$id'";
        $res = $conn->query($query);
        if ($user = $res->fetch_assoc()) {
            $name = $user['name'];
            $email = $user['email'];
            $subject = "Thank you for Registering for HR Festival on 05 July 2025 (Saturday) at Chennai Trade Centre, Chennai.";
            $message = '
            <!DOCTYPE html>
            <html>
            <head>
              <meta charset="UTF-8">
              <title>Registration Confirmation</title>
            </head>
            <body style="background:#f6f8fa;padding:30px 0;">
              <table align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width:480px;background:#ffffff;border-radius:10px;border:1px solid #e0e0e0;">
                <tr>
                  <td align="center" style="padding:32px 24px 16px 24px;">
                    <img src="https://vanakkamhrd.com/assets/images/VHRD%20Logo.png" alt="Vanakkam HRD" width="120" style="margin-bottom:16px;">
                    <h2 style="font-family:sans-serif;color:#222;margin:0 0 12px 0;">Dear '.htmlspecialchars($name).',</h2>
                    <p style="font-family:sans-serif;color:#444;font-size:16px;margin:0 0 18px 0;">
                      <b>Greetings from Vanakkam HRD!</b>
                    </p>
                    <p style="font-family:sans-serif;color:#444;font-size:16px;margin:0 0 18px 0;">
                      Your Registration for <b>HR Festival 2025 - Chennai</b> is <b>Confirmed</b>.
                    </p>
                    <div style="background:#eafaf1;padding:18px 12px;border-radius:8px;margin-bottom:18px;">
                      <span style="font-family:sans-serif;color:#222;font-size:15px;">Your Registration Name:</span><br>
                      <span style="font-size:22px;font-weight:bold;color:#27ae60;letter-spacing:2px;">'.htmlspecialchars($name).'</span>
                    </div>
                    <p style="font-family:sans-serif;color:#444;font-size:15px;margin:0 0 18px 0;">
                      <b>Venue:</b> Chennai Trade Centre, Nandambakkam, Chennai 600089.
                    </p>
                    <p style="font-family:sans-serif;color:#444;font-size:15px;margin:0 0 10px 0;">
                      <b>Google Map:</b> <a href="https://maps.google.com/?q=Chennai+Trade+Centre,+Chennai" target="_blank">https://maps.google.com/?q=Chennai+Trade+Centre,+Chennai</a>
                    </p>
                    <div style="margin:24px 0 0 0;text-align:center;">
                      <a href="https://vanakkamhrd.com/events.php#agenda" target="_blank" style="display:inline-block;font-size:16px;padding:10px 28px;border-radius:30px;background:#12037f;color:#fff;text-decoration:none;margin-bottom:18px;">
                        View Agenda
                      </a>
                    </div>
                    <div style="font-family:sans-serif;color:#444;font-size:15px;text-align:left;max-width:400px;margin:24px auto 24px auto;">
                      <ul style="padding-left:18px;margin:0;">
                        <li>Registration check-in counters will be open by <b>8:30 AM.</li><br>
                        <li>You can walk to any registration check-in counter and kindly mention the registration name to collect your entry badge.</li><br>
                        <li>Without the badge, you will not be allowed to enter the main conference hall.</li><br>
                        <li>Request you to kindly occupy the seats in the main conference hall for the inauguration by <b>09:30 AM</b>.</li><br>
                        <li>Kindly visit the stalls at the conference, which might be of some interest to you.</li><br>
                        <li>A separate photobooth is arranged for photoshoots, so make it convenient to take photos and it will be updated on our event website after the event.</li><br>
                        <li>Kindly share your valuable bytes video feedback, at during the event.</li><br>
                        <li>For any support during the entire day, kindly reach out to the team, Vanakkam HRD.</li>
                      </ul>
                    </div>
                    <p style="font-family:sans-serif;color:#444;font-size:15px;margin:18px 0 18px 0;">
                      Our agenda includes thought-provoking sessions and networking opportunities with industry experts. This is a great chance to enhance your knowledge and forge valuable connections.
                    </p>
                    <p style="font-family:sans-serif;color:#444;font-size:15px;margin:18px 0 18px 0;">
                      <b>We look forward to welcoming you to Vanakkam HRD HR Festival 2025 Chennai!</b>
                    </p>
                    <div style="margin:32px 0 0 0;text-align:center;">
                      <a href="https://facebook.com/vanakkamhrd" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/facebook.png" alt="Facebook" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                      <a href="https://www.youtube.com/@vanakkamhrd" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/youtube-play.png" alt="YouTube" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                      <a href="https://linkedin.com/company/vanakkamhrd" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/linkedin.png" alt="LinkedIn" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                      <a href="https://instagram.com/vanakkamhrd" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/instagram-new.png" alt="Instagram" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                    </div>
                    <p style="font-family:sans-serif;color:#888;font-size:13px;margin:24px 0 0 0;">
                      <b>Sincerely,</b><br>
                      <b>Rajeshwaran P</b><br>
                      Founder<br>
                      Vanakkam HRD<br>
                      Mobile: +91 82482 38229
                    </p>
                  </td>
                </tr>
              </table>
            </body>
            </html>
            ';
            if (send_email($email, $subject, $message)) {
                $update_query = "UPDATE event_registers SET email_sent = 1 WHERE id = '$id'";
                $conn->query($update_query);
            }
        }
    }
    $emailSent = true;
}

// Fetch all columns for 100 users for the current page, ordered by id ASC
$col_list = implode(", ", array_map(function($c){ return "`$c`"; }, $columns));
$result = $conn->query("SELECT $col_list FROM event_registers $search_sql ORDER BY id ASC LIMIT $start_from, $results_per_page");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send Confirmation Emails</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .sent-label { color: green; font-weight: bold; }
        .not-sent-label { color: red; font-weight: bold; }
        .centered-cell { text-align: center; vertical-align: middle !important; }
        .table-responsive { overflow-x: auto; }
        .custom-table-container {
            background: #fff;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        th.sticky-header {
            position: sticky;
            top: 0;
            background: #f8f9fa;
            z-index: 2;
        }
        table th, table td {
            white-space: nowrap;
        }
        .social-icons-footer {
            text-align: center;
            margin: 40px 0 10px 0;
        }
        .social-icons-footer a {
            margin: 0 10px;
            display: inline-block;
        }
        .social-icons-footer img {
            width: 32px;
            height: 32px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Send Confirmation Emails</h2>
    <!-- Search Form -->
    <form method="get" class="mb-3">
        <div class="input-group" style="max-width:400px;margin:auto;">
            <input type="text" name="search" class="form-control" placeholder="Search by name, email, or contact" value="<?= htmlspecialchars($search) ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i> Search</button>
                <?php if ($search): ?>
                    <a href="send_confirmation.php" class="btn btn-outline-secondary">Reset</a>
                <?php endif; ?>
            </div>
        </div>
    </form>
    <div class="table-responsive custom-table-container">
    <form method="post" id="confirmationForm">
        <table class="table table-bordered table-hover table-striped mb-0">
            <thead>
                <tr>
                    <th class="sticky-header"><input type="checkbox" id="select_all"></th>
                    <?php foreach ($columns as $col): ?>
                        <th class="sticky-header"><?= htmlspecialchars(ucwords(str_replace('_', ' ', $col))) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="centered-cell">
                        <?php if (isset($row['email_sent']) && $row['email_sent'] != 1): ?>
                            <input type="checkbox" name="user_ids[]" value="<?= $row['id'] ?>" class="user-checkbox">
                        <?php endif; ?>
                    </td>
                    <?php foreach ($columns as $col): ?>
                        <td class="centered-cell">
                            <?php
                                if ($col === 'email_sent') {
                                    if ($row[$col] == 1) {
                                        echo '<span class="sent-label">Sent</span>';
                                    } else {
                                        echo '<span class="not-sent-label">Not Sent</span>';
                                    }
                                } else {
                                    echo htmlspecialchars($row[$col]);
                                }
                            ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <button type="submit" class="btn btn-primary" id="sendBtn">Send Confirmation Email</button>
            <span id="selectedCount" class="font-weight-bold">Selected: 0</span>
        </div>
        <br>
        <p>Total Users: <?= $total_results ?> | Page <?= $page ?> of <?= $total_pages ?></p>
        <input type="hidden" name="total_pages" value="<?= $total_pages ?>">
        <!-- Pagination Links -->
        <nav>
          <ul class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
              <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?><?= $search ? '&search='.urlencode($search) : '' ?>"><?= $i ?></a>
              </li>
            <?php endfor; ?>
          </ul>
        </nav>
    </form>
    </div>
    <div class="mt-4 mb-2 text-center">
        <span class="badge badge-success" style="font-size:16px;">Total Mails Sent: <?= $count_sent ?></span>
        <span class="badge badge-danger" style="font-size:16px;">Unsent: <?= $count_unsent ?></span>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    // Select/Deselect all checkboxes
    document.getElementById('select_all').onclick = function() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"][name="user_ids[]"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
        updateSelectedCount();
    }

    // Update selected count
    function updateSelectedCount() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"][name="user_ids[]"]');
        var count = 0;
        for (var checkbox of checkboxes) {
            if (checkbox.checked) count++;
        }
        document.getElementById('selectedCount').innerText = "Selected: " + count;
    }

    // Add event listeners to checkboxes
    var userCheckboxes = document.querySelectorAll('input[type="checkbox"][name="user_ids[]"]');
    for (var checkbox of userCheckboxes) {
        checkbox.addEventListener('change', updateSelectedCount);
    }

    // SweetAlert2 for confirmation and alerts
    let form = document.getElementById('confirmationForm');
    let shouldSubmit = false;

    form.onsubmit = function(e) {
        if (shouldSubmit) {
            shouldSubmit = false;
            return true;
        }
        var count = document.querySelectorAll('input[type="checkbox"][name="user_ids[]"]:checked').length;
        if (count === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Selection',
                text: 'Please select at least one user to send confirmation email.',
                confirmButtonColor: '#dc3545'
            });
            return false;
        }
        Swal.fire({
            title: 'Are you sure?',
            text: "Send confirmation mail for the selected " + count + " register(s)?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Send'
        }).then((result) => {
            if (result.isConfirmed) {
                shouldSubmit = true;
                form.submit();
            }
        });
        return false;
    };

    // Initial count update
    updateSelectedCount();

    // Show success alert if emails sent
    <?php if ($emailSent): ?>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Confirmation emails sent to selected users!',
                confirmButtonColor: '#28a745'
            });
        });
    <?php endif; ?>
</script>
</body>
</html>