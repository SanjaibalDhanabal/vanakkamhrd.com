<?php
// filepath: c:\xampp\htdocs\public_html\join_community.php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
require_once('./includes/db_connect.php');

// Handle Add User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $personal_email = $conn->real_escape_string($_POST['personal_email']);
    $official_email = $conn->real_escape_string($_POST['official_email']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $designation = $conn->real_escape_string($_POST['designation']);
    $company = $conn->real_escape_string($_POST['company']);
    $industry = $conn->real_escape_string($_POST['industry']);
    $linkedin = $conn->real_escape_string($_POST['linkedin']);
    $state = $conn->real_escape_string($_POST['state']);
    $city = $conn->real_escape_string($_POST['city']);
    $images = $conn->real_escape_string($_POST['images']);
    $sql = "INSERT INTO community_member (name, personal_email, official_email, contact, gender, designation, company, industry, linkedin, state, city, images)
            VALUES ('$name', '$personal_email', '$official_email', '$contact', '$gender', '$designation', '$company', '$industry', '$linkedin', '$state', '$city', '$images')";
    $conn->query($sql);
    header("Location: join_community.php?added=1");
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM community_member WHERE id=$id");
    header("Location: join_community.php?deleted=1");
    exit;
}

// Handle Bulk Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bulk_delete_ids'])) {
    $ids = array_map('intval', $_POST['bulk_delete_ids']);
    if ($ids) {
        $idList = implode(',', $ids);
        $conn->query("DELETE FROM community_member WHERE id IN ($idList)");
        header("Location: join_community.php?deleted=1");
        exit;
    }
}

// Handle Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $id = intval($_POST['edit_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $personal_email = $conn->real_escape_string($_POST['personal_email']);
    $official_email = $conn->real_escape_string($_POST['official_email']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $designation = $conn->real_escape_string($_POST['designation']);
    $company = $conn->real_escape_string($_POST['company']);
    $industry = $conn->real_escape_string($_POST['industry']);
    $linkedin = $conn->real_escape_string($_POST['linkedin']);
    $state = $conn->real_escape_string($_POST['state']);
    $city = $conn->real_escape_string($_POST['city']);
    $images = $conn->real_escape_string($_POST['images']);
    $sql = "UPDATE community_member SET
            name='$name', personal_email='$personal_email', official_email='$official_email', contact='$contact', gender='$gender',
            designation='$designation', company='$company', industry='$industry', linkedin='$linkedin', state='$state', city='$city', images='$images'
            WHERE id=$id";
    $conn->query($sql);
    header("Location: join_community.php?edited=1");
    exit;
}

// Pagination setup
$limit = 50;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;
$count_total = $conn->query("SELECT COUNT(*) as c FROM community_member")->fetch_assoc()['c'];
$total_pages = ceil($count_total / $limit);

// Fetch community members for current page
$sql = "SELECT * FROM community_member ORDER BY id ASC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Community Members List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background: #f8f9fa; }
        .container { margin-top: 40px; }
        .table thead { background: #1a237e; color: #fff; }
        .table tbody tr:nth-child(even) { background: #f1f1f1; }
        h2 { color: #1a237e; margin-bottom: 24px; }
        .add-btn {
            font-size: 1.6rem;
            color: #fff;
            background: #1a237e;
            border-radius: 50%;
            width: 40px; height: 40px;
            display: flex; align-items: center; justify-content: center;
            border: none;
            position: absolute; right: 30px; top: 30px;
            cursor: pointer;
        }
        .modal-backdrop.show { opacity: 0.3; }
        .table-responsive {
            min-width: 1000px;
            overflow-x: auto;
        }
        .table {
            font-size: 1rem;
            min-width: 1200px;
        }
        th, td {
            padding: 0.85rem 1.1rem !important;
        }
        .container {
            max-width: 100vw;
            overflow-x: auto;
        }
        .table td, .table th {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 220px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        /* Bottom controls styling */
        .bottom-controls {
            width: 100%;
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #selectedCountText {
            min-width: 120px;
            text-align: right;
            font-weight: bold;
        }
        #bulkDeleteBtn {
            min-width: 180px;
        }
    </style>
</head>
<body>
<div class="container position-relative">
    <h2 style="text-align: center;">Community Members List</h2>
    <div class="mb-3">
        <span class="badge bg-primary fs-5">Total Members: <?= $count_total ?></span>
    </div>
    <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addUserModal" title="Add User">
        <i class="fa fa-plus"></i>
    </button>
    <div class="d-flex mb-2 gap-2 align-items-center">
        <input type="text" class="form-control w-auto" style="max-width:300px;" id="globalSearchInput" placeholder="Search..." onkeyup="globalSearchTable()">
        <a class="btn btn-outline-success ms-2" href="community_member_export.php">
            <i class="fa fa-file-excel"></i> Export to Excel
        </a>
    </div>
    <form id="bulkDeleteForm" method="post">
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle" id="regTable">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>#</th>
                    <th>Name</th>
                    <th>Personal Email</th>
                    <th>Official Email</th>
                    <th>Contact</th>
                    <th>Gender</th>
                    <th>Designation</th>
                    <th>Company</th>
                    <th>Industry</th>
                    <th>LinkedIn</th>
                    <th>Image/PDF</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php $i = $offset + 1; while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="row-checkbox" name="bulk_delete_ids[]" value="<?= $row['id'] ?>">
                        </td>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['personal_email']) ?></td>
                        <td><?= htmlspecialchars($row['official_email']) ?></td>
                        <td><?= htmlspecialchars($row['contact']) ?></td>
                        <td><?= htmlspecialchars($row['gender']) ?></td>
                        <td><?= htmlspecialchars($row['designation']) ?></td>
                        <td><?= htmlspecialchars($row['company']) ?></td>
                        <td><?= htmlspecialchars($row['industry']) ?></td>
                        <td><a href="<?= htmlspecialchars($row['linkedin']) ?>" target="_blank">View Profile</a></td>
                        <td>
                            <?php
                            $image_path = $row['images'];
                            if (pathinfo($image_path, PATHINFO_EXTENSION) == 'pdf') {
                                echo "<a href='$image_path' target='_blank'>Download PDF</a>";
                            } else {
                                echo "<img src='$image_path' alt='Profile Image' style='max-width:48px;max-height:48px;border-radius:6px;border:1px solid #e5e7eb;'/>";
                            }
                            ?>
                        </td>
                        <td><?= htmlspecialchars($row['state']) ?></td>
                        <td><?= htmlspecialchars($row['city']) ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" onclick="openEditModal(
                                <?= $row['id'] ?>,
                                '<?= htmlspecialchars(addslashes($row['name'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['personal_email'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['official_email'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['contact'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['gender'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['designation'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['company'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['industry'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['linkedin'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['state'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['city'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['images'])) ?>'
                            )"><i class="fa fa-edit"></i></button>
                            <a href="#" class="btn btn-sm btn-danger"
                               onclick="return confirmDelete('?delete=<?= $row['id'] ?>')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="15" class="text-center">No community members found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <!-- Bulk Delete Button and Selected Count at Bottom (like your screenshot) -->
        <div class="bottom-controls">
            <button class="btn btn-danger" id="bulkDeleteBtn" type="button">
                <i class="fa fa-trash"></i> Delete Selected
            </button>
            <div id="selectedCountText">
                Selected: <span id="selectedCount">0</span>
            </div>
        </div>
    </div>
    </form>
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
        <h5 class="modal-title" id="addUserModalLabel">Add Community Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2"><input required name="name" class="form-control" placeholder="Name"></div>
        <div class="mb-2"><input required name="personal_email" class="form-control" placeholder="Personal Email"></div>
        <div class="mb-2"><input required name="official_email" class="form-control" placeholder="Official Email"></div>
        <div class="mb-2"><input required name="contact" class="form-control" placeholder="Contact"></div>
        <div class="mb-2"><input required name="gender" class="form-control" placeholder="Gender"></div>
        <div class="mb-2"><input required name="designation" class="form-control" placeholder="Designation"></div>
        <div class="mb-2"><input required name="company" class="form-control" placeholder="Company"></div>
        <div class="mb-2"><input required name="industry" class="form-control" placeholder="Industry"></div>
        <div class="mb-2"><input required name="linkedin" class="form-control" placeholder="LinkedIn"></div>
        <div class="mb-2"><input required name="state" class="form-control" placeholder="State"></div>
        <div class="mb-2"><input required name="city" class="form-control" placeholder="City"></div>
        <div class="mb-2"><input required name="images" class="form-control" placeholder="Image/PDF Path"></div>
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
        <h5 class="modal-title" id="editUserModalLabel">Edit Community Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2"><input required name="name" id="edit_name" class="form-control" placeholder="Name"></div>
        <div class="mb-2"><input required name="personal_email" id="edit_personal_email" class="form-control" placeholder="Personal Email"></div>
        <div class="mb-2"><input required name="official_email" id="edit_official_email" class="form-control" placeholder="Official Email"></div>
        <div class="mb-2"><input required name="contact" id="edit_contact" class="form-control" placeholder="Contact"></div>
        <div class="mb-2"><input required name="gender" id="edit_gender" class="form-control" placeholder="Gender"></div>
        <div class="mb-2"><input required name="designation" id="edit_designation" class="form-control" placeholder="Designation"></div>
        <div class="mb-2"><input required name="company" id="edit_company" class="form-control" placeholder="Company"></div>
        <div class="mb-2"><input required name="industry" id="edit_industry" class="form-control" placeholder="Industry"></div>
        <div class="mb-2"><input required name="linkedin" id="edit_linkedin" class="form-control" placeholder="LinkedIn"></div>
        <div class="mb-2"><input required name="state" id="edit_state" class="form-control" placeholder="State"></div>
        <div class="mb-2"><input required name="city" id="edit_city" class="form-control" placeholder="City"></div>
        <div class="mb-2"><input required name="images" id="edit_images" class="form-control" placeholder="Image/PDF Path"></div>
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
// SweetAlert for Add User Success
<?php if (isset($_GET['added']) && $_GET['added'] == 1): ?>
Swal.fire({icon: 'success', title: 'Member Added!', showConfirmButton: false, timer: 1500});
<?php endif; ?>

// SweetAlert for Edit User Success
<?php if (isset($_GET['edited']) && $_GET['edited'] == 1): ?>
Swal.fire({icon: 'success', title: 'Member Updated!', showConfirmButton: false, timer: 1500});
<?php endif; ?>

// SweetAlert for Delete Success
<?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
Swal.fire({icon: 'success', title: 'Member Deleted!', showConfirmButton: false, timer: 1500});
<?php endif; ?>

// Confirm before delete
function confirmDelete(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This member will be deleted!",
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

// Global search for all columns
function globalSearchTable() {
    var input = document.getElementById('globalSearchInput');
    var filter = input.value.toUpperCase();
    var table = document.getElementById("regTable");
    var tr = table.getElementsByTagName("tr");
    for (var i = 1; i < tr.length; i++) {
        var tds = tr[i].getElementsByTagName("td");
        var found = false;
        for (var j = 1; j < tds.length - 1; j++) { // skip # and action
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
function openEditModal(id, name, personal_email, official_email, contact, gender, designation, company, industry, linkedin, state, city, images) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_personal_email').value = personal_email;
    document.getElementById('edit_official_email').value = official_email;
    document.getElementById('edit_contact').value = contact;
    document.getElementById('edit_gender').value = gender;
    document.getElementById('edit_designation').value = designation;
    document.getElementById('edit_company').value = company;
    document.getElementById('edit_industry').value = industry;
    document.getElementById('edit_linkedin').value = linkedin;
    document.getElementById('edit_state').value = state;
    document.getElementById('edit_city').value = city;
    document.getElementById('edit_images').value = images;
    var editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
    editModal.show();
}

// Selected count update (like your screenshot)
function updateSelectedCount() {
    let selected = document.querySelectorAll('.row-checkbox:checked').length;
    document.getElementById('selectedCount').textContent = selected;
}
document.querySelectorAll('.row-checkbox').forEach(cb => {
    cb.addEventListener('change', updateSelectedCount);
});
document.getElementById('selectAll').addEventListener('change', function() {
    let checked = this.checked;
    document.querySelectorAll('.row-checkbox').forEach(cb => {
        cb.checked = checked;
    });
    updateSelectedCount();
});

// Bulk Delete with SweetAlert and count
document.getElementById('bulkDeleteBtn').addEventListener('click', function(e) {
    e.preventDefault();
    let selected = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);
    let count = selected.length;
    if (count === 0) {
        Swal.fire('No selection', 'Please select at least one member to delete.', 'warning');
        return;
    }
    Swal.fire({
        title: 'Are you sure?',
        html: `You are about to delete <b>${count}</b> member(s)!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: `Yes, delete ${count}!`
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('bulkDeleteForm').submit();
        }
    });
});
</script>
</body>
</html>
<?php
$conn->close();
?>