<?php

require_once('../includes/db_connect.php');

// if $conn was closed elsewhere, try to include again (use include/require to reinitialize)
if (!isset($conn) || !($conn instanceof mysqli) || (method_exists($conn, 'ping') && !$conn->ping())) {
    require('../includes/db_connect.php');
}

// helper to safely run COUNT queries and avoid calling methods on closed/invalid $conn
function safe_count($conn, $sql) {
    if (!isset($conn) || !($conn instanceof mysqli) || (method_exists($conn, 'ping') && !$conn->ping())) {
        return 0;
    }
    $res = $conn->query($sql);
    if ($res && $row = $res->fetch_assoc()) {
        return isset($row['c']) ? intval($row['c']) : 0;
    }
    return 0;
}

// Pagination setup
$limit = 50;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Counts (use safe_count)
$count_total = safe_count($conn, "SELECT COUNT(*) as c FROM event_registers");
$count_paid = safe_count($conn, "SELECT COUNT(*) as c FROM event_registers WHERE payment_status=1");
$count_unpaid = safe_count($conn, "SELECT COUNT(*) as c FROM event_registers WHERE payment_status=0");
$count_email_sent = safe_count($conn, "SELECT COUNT(*) as c FROM event_registers WHERE email_sent=1");
$count_email_unsent = safe_count($conn, "SELECT COUNT(*) as c FROM event_registers WHERE email_sent=0");
$count_cert_sent = safe_count($conn, "SELECT COUNT(*) as c FROM event_registers WHERE certificate_sent=1");
$count_cert_unsent = safe_count($conn, "SELECT COUNT(*) as c FROM event_registers WHERE certificate_sent=0");
$total_pages = $limit > 0 ? ceil($count_total / $limit) : 1;

// Handle Add User (photo upload temporarily disabled)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $company = $conn->real_escape_string($_POST['company']);
    $designation = $conn->real_escape_string($_POST['designation']);
    $options = $conn->real_escape_string($_POST['options']);
    // Get payment status from form
    $payment_status = isset($_POST['payment_status']) ? intval($_POST['payment_status']) : 0;

    // Generate order_id
    $order_id = uniqid('ORD');

    $sql = "INSERT INTO event_registers (name, email, contact, company, designation, options, order_id, payment_status, created_time) VALUES
        ('$name', '$email', '$contact', '$company', '$designation', '$options', '$order_id', $payment_status, NOW())";
    if (!$conn->query($sql)) {
        die("Insert Error: " . $conn->error);
    }
    $insert_id = $conn->insert_id;

    // Photo upload code is temporarily disabled
    /*
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
            $target = "../event_register/" . $insert_id . "." . $ext;
            move_uploaded_file($_FILES['photo']['tmp_name'], $target);
            $conn->query("UPDATE event_registers SET photo='{$insert_id}.{$ext}' WHERE id=$insert_id");
        }
    }
    */

    header("Location: hr_summit_2025_registration_list.php?added=1");
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM event_registers WHERE id=$id");
    header("Location: hr_summit_2025_registration_list.php?deleted=1");
    exit;
}

// Handle Edit (photo upload temporarily disabled)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $id = intval($_POST['edit_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $company = $conn->real_escape_string($_POST['company']);
    $designation = $conn->real_escape_string($_POST['designation']);
    $options = $conn->real_escape_string($_POST['options']);
    // read payment status from form
    $payment_status = isset($_POST['payment_status']) ? intval($_POST['payment_status']) : 0;

    $sql = "UPDATE event_registers SET
            name='$name', email='$email', contact='$contact', company='$company', designation='$designation', options='$options', payment_status=$payment_status
            WHERE id=$id";
    $conn->query($sql);

    // Photo upload code is temporarily disabled
    /*
    if (isset($_FILES['edit_photo']) && $_FILES['edit_photo']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['edit_photo']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
            $target = "../event_register/" . $id . "." . $ext;
            move_uploaded_file($_FILES['edit_photo']['tmp_name'], $target);
            $conn->query("UPDATE event_registers SET photo='{$id}.{$ext}' WHERE id=$id");
        }
    }
    */

    header("Location: hr_summit_2025_registration_list.php?edited=1");
    exit;
}

// Handle Bulk Confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bulk_confirm']) && isset($_POST['selected_ids'])) {
    $ids = array_map('intval', $_POST['selected_ids']);
    foreach ($ids as $id) {
        $conn->query("UPDATE event_registers SET email_sent=1 WHERE id=$id");
    }
    header("Location: hr_summit_2025_registration_list.php?bulk=confirm");
    exit;
}

// Send confirmation email (example, adjust as needed)
if (isset($_GET['send']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $res = $conn->query("SELECT name, email FROM event_registers WHERE id=$id");
    if ($res && $row = $res->fetch_assoc()) {
        $name = $row['name'];
        $email = $row['email'];
        $subject = "Registration Confirmed for HR Summit 2025";
        $message = "
        <html>
        <body>
        <p>Dear ".htmlspecialchars($name).",</p>
        <p>Your registration for HR Summit 2025 is <b>confirmed</b>!</p>
        <p>We look forward to seeing you at the event.</p>
        <p>Regards,<br>Vanakkam HRD Team</p>
        </body>
        </html>";
        // sendMail($email, $subject, $message); // Implement your mail function
        $conn->query("UPDATE event_registers SET email_sent=1 WHERE id=$id");
        header("Location: hr_summit_2025_registration_list.php?single=confirm");
        exit;
    }
}

// Fetch records (order by created_time ASC for registration order)
$sql = "SELECT * FROM event_registers ORDER BY created_time ASC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>TN HR Summit 2025 - Registration List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background: #f8f9fa; }
        .container { margin-top: 40px; }
        .table thead { background: #1a237e; color: #fff; }
        .table tbody tr:nth-child(even) { background: #f1f1f1; }
        h2 { color: #1a237e; margin-bottom: 24px; }
        .photo-thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #ccc; }
        .table td, .table th { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 220px; }
        .text-center-important { text-align: center !important; vertical-align: middle !important; }
    </style>
</head>
<body>
<div class="container position-relative">
    <h2 class="text-center">Registered Users - TN HR Summit 2025</h2>
    <div class="d-flex gap-3 mb-3 flex-wrap">
        <div class="badge bg-primary fs-6 px-3 py-2">Total Registered: <?= $count_total ?></div>
        <div class="badge bg-success fs-6 px-3 py-2">Paid: <?= $count_paid ?></div>
        <div class="badge bg-warning text-dark fs-6 px-3 py-2">Unpaid: <?= $count_unpaid ?></div>
        <div class="badge bg-info text-dark fs-6 px-3 py-2">Emails Sent: <?= $count_email_sent ?></div>
        <div class="badge bg-secondary fs-6 px-3 py-2">Emails Unsent: <?= $count_email_unsent ?></div>
        <div class="badge bg-success fs-6 px-3 py-2">Certificates Sent: <?= $count_cert_sent ?></div>
        <div class="badge bg-danger fs-6 px-3 py-2">Certificates Unsent: <?= $count_cert_unsent ?></div>
    </div>
   <div class="d-flex mb-2 gap-2 align-items-center">
        <div class="input-group" style="max-width:300px;">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" id="globalSearchInput" placeholder="Search..." onkeyup="globalSearchTable()">
        </div>
        <a class="btn btn-outline-success ms-2" href="hr_summit_2025_registration_export.php">
            <i class="fa fa-file-excel"></i> Export to Excel
        </a>
        <form method="post" id="bulkForm" class="ms-2 d-inline">
            <input type="hidden" name="bulk_confirm" value="1">
            <button type="submit" class="btn btn-outline-primary" id="bulkConfirmBtn">
                <i class="fa fa-check"></i> Send Bulk Confirmation
            </button>
        </form>
        <button class="btn btn-outline-dark ms-2" data-bs-toggle="modal" data-bs-target="#addUserModal" title="Add User">
            <i class="fa fa-plus"></i> Add User
        </button>
    </div>
    <div class="table-responsive">
        <form method="post" id="bulkSelectForm">
        <table class="table table-bordered table-hover align-middle" id="regTable">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll" onclick="toggleAll(this)"></th>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Company</th>
                    <th>Designation</th>
                    <th>Options</th>
                    <th>Order ID</th>
                    <th class="text-center">Payment Status</th>
                    <th>Created Time</th>
                    <th class="text-center">Email Sent</th>
                    <th class="text-center">Certificate Sent</th>
                    <th class="text-center">Send Confirmation</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php $i = $offset + 1; while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_ids[]" value="<?= $row['id'] ?>">
                        </td>
                        <td><?= $i++ ?></td>
                        <td>
                            <?php
                                $photo = '';
                                $photo_jpg = "../event_register/" . $row['id'] . ".jpg";
                                $photo_png = "../event_register/" . $row['id'] . ".png";
                                $photo_jpeg = "../event_register/" . $row['id'] . ".jpeg";
                                if (file_exists($photo_jpg)) $photo = $photo_jpg;
                                elseif (file_exists($photo_png)) $photo = $photo_png;
                                elseif (file_exists($photo_jpeg)) $photo = $photo_jpeg;
                                if ($photo) {
                                    echo '<img src="'.$photo.'" class="photo-thumb" alt="Photo">';
                                } else {
                                    echo '<span class="text-muted">No Photo</span>';
                                }
                            ?>
                        </td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['contact']) ?></td>
                        <td><?= htmlspecialchars($row['company']) ?></td>
                        <td><?= htmlspecialchars($row['designation']) ?></td>
                        <td><?= htmlspecialchars($row['options']) ?></td>
                        <td><?= htmlspecialchars($row['order_id']) ?></td>
                        <td class="text-center-important">
                            <?php if ($row['payment_status'] == 1): ?>
                                <span class="text-success fw-bold">Paid</span>
                            <?php else: ?>
                                <span class="text-warning fw-bold">Unpaid</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['created_time']) ?></td>
                        <td class="text-center-important"><?= $row['email_sent'] ? 'Yes' : 'No' ?></td>
                        <td class="text-center-important"><?= $row['certificate_sent'] ? 'Yes' : 'No' ?></td>
                        <td class="text-center-important">
                            <a href="?send=confirm&id=<?= $row['id'] ?>" class="btn btn-success btn-sm"
                               onclick="return confirmAction('?send=confirm&id=<?= $row['id'] ?>','confirm')">
                                <i class="fa fa-check"></i>
                            </a>
                        </td>
                        <td class="text-center-important">
                            <button type="button" class="btn btn-sm btn-primary" onclick="openEditModal(
                                <?= $row['id'] ?>,
                                '<?= htmlspecialchars(addslashes($row['name'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['email'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['contact'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['company'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['designation'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['options'])) ?>',
                                <?= (int)$row['payment_status'] ?>
                            )"><i class="fa fa-edit"></i></button>
                            <a href="#" class="btn btn-sm btn-danger"
                               onclick="return confirmDelete('?delete=<?= $row['id'] ?>')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="16" class="text-center">No registrations found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </form>
    </div>
    <!-- Pagination -->
    <nav>
        <ul class="pagination mt-4 justify-content-center">
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

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
            <label for="add_name" class="form-label">Name</label>
            <input required name="name" id="add_name" class="form-control" placeholder="Name">
        </div>
        <div class="mb-2">
            <label for="add_email" class="form-label">Email</label>
            <input required name="email" id="add_email" type="email" class="form-control" placeholder="Email">
        </div>
        <div class="mb-2">
            <label for="add_contact" class="form-label">Contact</label>
            <input required name="contact" id="add_contact" class="form-control" placeholder="Contact">
        </div>
        <div class="mb-2">
            <label for="add_company" class="form-label">Company</label>
            <input required name="company" id="add_company" class="form-control" placeholder="Company">
        </div>
        <div class="mb-2">
            <label for="add_designation" class="form-label">Designation</label>
            <input required name="designation" id="add_designation" class="form-control" placeholder="Designation">
        </div>
        <div class="mb-2">
            <label for="add_options" class="form-label">Options</label>
            <input required name="options" id="add_options" class="form-control" placeholder="Options">
        </div>
        <!-- Payment status field for Add User -->
        <div class="mb-2">
            <label for="add_payment_status" class="form-label">Payment Status</label>
            <select name="payment_status" id="add_payment_status" class="form-select">
                <option value="0">Unpaid</option>
                <option value="1">Paid</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="add_user" class="btn btn-success">Add</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" class="modal-content">
      <input type="hidden" name="edit_id" id="edit_id">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
            <label for="edit_name" class="form-label">Name</label>
            <input required name="name" id="edit_name" class="form-control" placeholder="Name">
        </div>
        <div class="mb-2">
            <label for="edit_email" class="form-label">Email</label>
            <input required name="email" id="edit_email" type="email" class="form-control" placeholder="Email">
        </div>
        <div class="mb-2">
            <label for="edit_contact" class="form-label">Contact</label>
            <input required name="contact" id="edit_contact" class="form-control" placeholder="Contact">
        </div>
        <div class="mb-2">
            <label for="edit_company" class="form-label">Company</label>
            <input required name="company" id="edit_company" class="form-control" placeholder="Company">
        </div>
        <div class="mb-2">
            <label for="edit_designation" class="form-label">Designation</label>
            <input required name="designation" id="edit_designation" class="form-control" placeholder="Designation">
        </div>
        <div class="mb-2">
            <label for="edit_options" class="form-label">Options</label>
            <input required name="options" id="edit_options" class="form-control" placeholder="Options">
        </div>
        <!-- Payment status field for Edit User -->
        <div class="mb-2">
            <label for="edit_payment_status" class="form-label">Payment Status</label>
            <select name="payment_status" id="edit_payment_status" class="form-select">
                <option value="0">Unpaid</option>
                <option value="1">Paid</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="edit_user" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// SweetAlert for Add/Edit/Delete/Bulk/Single actions
<?php if (isset($_GET['added']) && $_GET['added'] == 1): ?>
Swal.fire({icon: 'success', title: 'User Added!', showConfirmButton: false, timer: 1500});
<?php endif; ?>
<?php if (isset($_GET['edited']) && $_GET['edited'] == 1): ?>
Swal.fire({icon: 'success', title: 'User Updated!', showConfirmButton: false, timer: 1500});
<?php endif; ?>
<?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
Swal.fire({icon: 'success', title: 'User Deleted!', showConfirmButton: false, timer: 1500});
<?php endif; ?>
<?php if (isset($_GET['bulk']) && $_GET['bulk'] == 'confirm'): ?>
Swal.fire({icon: 'success', title: 'Bulk Confirmation Sent!', showConfirmButton: false, timer: 1500});
<?php endif; ?>
<?php if (isset($_GET['single']) && $_GET['single'] == 'confirm'): ?>
Swal.fire({icon: 'success', title: 'Confirmation Sent!', showConfirmButton: false, timer: 1500});
<?php endif; ?>

function toggleAll(source) {
    var checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
    }
}

// Confirm before delete
function confirmDelete(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This user will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
    return false;
}

// Confirm before single confirm
function confirmAction(url, type) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Send confirmation email?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
    return false;
}

// Bulk confirmation alert
var bulkForm = document.getElementById('bulkForm');
if (bulkForm) {
    bulkForm.onsubmit = function(e) {
        var checked = document.querySelectorAll('input[name="selected_ids[]"]:checked').length;
        if (!checked) {
            Swal.fire({icon: 'warning', title: 'No users selected!', showConfirmButton: false, timer: 1500});
            return false;
        }
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            html: "Send confirmation emails to <b>" + checked + "</b> selected user(s)?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
        return false;
    };
}

// Global search for all columns
function globalSearchTable() {
    var input = document.getElementById('globalSearchInput');
    var filter = input.value.toUpperCase();
    var table = document.getElementById("regTable");
    var tr = table.getElementsByTagName("tr");
    for (var i = 1; i < tr.length; i++) {
        var tds = tr[i].getElementsByTagName("td");
        var found = false;
        for (var j = 0; j < tds.length; j++) {
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

// Edit modal fill
function openEditModal(id, name, email, contact, company, designation, options, payment_status) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_contact').value = contact;
    document.getElementById('edit_company').value = company;
    document.getElementById('edit_designation').value = designation;
    document.getElementById('edit_options').value = options;
    // set payment status select
    var ps = document.getElementById('edit_payment_status');
    if (ps) ps.value = (typeof payment_status !== 'undefined') ? payment_status : '0';
    var editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
    editModal.show();
}
</script>
</body>
</html>
<?php
if (isset($conn) && ($conn instanceof mysqli)) {
    $conn->close();
}
?>