<?php
// filepath: c:\xampp\htdocs\public_html\hr_confluence_2025_checkin.php

$conn = new mysqli('localhost', 'vana_test', 'Admin@123###', 'vana_test');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$show_alert = false;
$alert_type = 'error';
$alert_title = '';
$alert_html = '';
$user_data = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkin_submit'])) {
    $input = trim($_POST['user_input']);
    // Server-side validation
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        $where = "email='" . $conn->real_escape_string($input) . "'";
    } elseif (preg_match('/^\d{10}$/', $input)) {
        $where = "contact='" . $conn->real_escape_string($input) . "'";
    } else {
        $show_alert = true;
        $alert_type = 'error';
        $alert_title = 'Invalid Input';
        $alert_html = 'Please enter a valid email or 10-digit contact number.';
    }

    if (!$show_alert) {
        $sql = "SELECT * FROM hr_confluence_2025_registrations WHERE $where LIMIT 1";
        $res = $conn->query($sql);
        if ($row = $res->fetch_assoc()) {
            $user_data = $row;
            $name = htmlspecialchars($row['name']);
            // If already checked in, show check-in completed with time
            if (!empty($row['checkin_time'])) {
                $show_alert = true;
                $alert_type = 'info';
                $alert_title = 'Check-In Already Completed';
                $alert_html = "<b>Name:</b> $name<br>
                    <b>Status:</b> " . ucfirst($row['status']) . "<br>
                    <b>Check-In Time:</b> " . htmlspecialchars($row['checkin_time']);
            } else {
                $checkin_time = date('Y-m-d H:i:s');
                // Set checkin_status message based on registration status
                if ($row['status'] === 'rejected') {
                    $checkin_status = 'Registration rejected, check-in success';
                    $statusText = 'Registration Rejected';
                } elseif ($row['status'] === 'pending') {
                    $checkin_status = 'Registration pending, check-in success';
                    $statusText = 'Registration Pending';
                } elseif ($row['status'] === 'approved') {
                    $checkin_status = 'Registration approved, check-in success';
                    $statusText = 'Registration Approved';
                } else {
                    $checkin_status = 'Check-in success';
                    $statusText = 'Check-In Success';
                }
                // Update check-in time and status in database
                $conn->query("UPDATE hr_confluence_2025_registrations SET checkin_time='$checkin_time', checkin_status='$checkin_status' WHERE id={$row['id']}");
                $show_alert = true;
                $alert_type = 'success';
                $alert_title = 'Check-In Successful!';
                $alert_html = "<b>Name:</b> $name<br>
                    <b>Status:</b> $statusText";
            }
        } else {
            $show_alert = true;
            $alert_type = 'error';
            $alert_title = 'Check-In Failed';
            $alert_html = 'You have not registered for this event.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HR Confluence 2025 Check-In</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
     <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .center-wrapper {
            width: 100vw;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            /* max-width: 430px; */
            width: 100%;
            margin: 0 auto;
            background: #fff;
            padding: 32px 18px 28px 18px;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(255,92,147,0.10);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-heading {
            text-align: center;
            font-size: 4rem;
            font-weight: 700;
            color: #12037f;
            margin-bottom: 8px;
            letter-spacing: 1px;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        }
        .form-subheading {
            text-align: center;
            font-size: 1.75rem;
            font-weight: 500;
            color: #ff5c93;
            margin-bottom: 18px;
            letter-spacing: 0.5px;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        }
        .reg-form {
            width: 100%;
        }
        .reg-form label {
            display: block;
            margin-top: 14px;
            font-weight: 600;
            color: #12037f;
            font-size: 1.95rem;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        }
        .reg-form input {
            width: 100%;
            padding: 10px 10px;
            margin-top: 4px;
            border-radius: 6px;
            border: 1.5px solid #ccc;
            font-size: 2.2rem;
            background: #f9fafb;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        }
        .reg-form input:focus {
            border-color: #ff5c93;
            box-shadow: 0 0 0 2px #ffe0ed;
            background: #fff;
        }
        .eventup-hero-btn {
            margin-top: 22px;
            width: 100%;
            background: linear-gradient(90deg, rgba(53, 24, 236, 1) 0%, #12037f 100%);
            color: #fff;
            border: none;
            padding: 13px 0;
            border-radius: 30px;
            font-size: 1.98rem;
            font-weight: 700;
            letter-spacing: 1px;
            cursor: pointer;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 16px rgba(255,92,147,0.13);
            text-transform: uppercase;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        }
        .eventup-hero-btn:hover {
            background: linear-gradient(90deg, #037f22ff 0%, #6aff5cff 100%);
        }
        @media (max-width: 900px) {
            .form-container {
                max-width: 95vw;
                padding: 24px 4vw 24px 4vw;
                border-radius: 14px;
            }
            .form-heading { font-size: 1.5rem; }
            .form-subheading { font-size: 1.05rem; }
        }
        @media (max-width: 600px) {
            .center-wrapper {
                padding: 0;
                min-height: 100vh;
            }
            .form-container {
                max-width: 99vw;
                width: 99vw;
                padding: 44px 4vw 44px 4vw; /* More padding */
                border-radius: 22px;
                box-shadow: 0 2px 18px rgba(255,92,147,0.13);
                margin: 0 auto;
            }
            .form-heading { font-size: 2.7rem; } /* Much larger */
            .form-subheading { font-size: 1.7rem; }
            .eventup-hero-btn { font-size: 1.5rem; padding: 28px 0; }
            .reg-form input { font-size: 1.5rem; padding: 26px 18px; }
            .reg-form label { font-size: 1.4rem; }
        }
    </style>
</head>
<body>
<div class="center-wrapper">
    <div class="form-container">
        <div class="form-heading">HR Confluence 2025</div>
        <div class="form-subheading">Check-In</div>
        <form class="reg-form" id="checkinForm" method="post" action="" autocomplete="on">
            <label>Enter your registered Email or Contact Number</label>
            <input type="text" name="user_input" required placeholder="Email or 10-digit Contact">
            <button type="submit" name="checkin_submit" value="1" class="eventup-hero-btn">Check In</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

<?php if ($show_alert): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: '<?= $alert_type ?>',
        title: '<?= $alert_title ?>',
        html: `<?= $alert_html ?>`,
        confirmButtonColor: '#ff5c93',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then(function() {
        window.location.href = window.location.pathname;
    });
});
</script>
<?php endif; ?>

<script>
function validateInput(input) {
    const val = input.value.trim();
    if (val === "") {
        input.style.background = "#ffeaea";
        input.setCustomValidity("Please enter your registered email or contact number.");
        return false;
    }
    if (/^\d{10}$/.test(val) || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
        input.style.background = "";
        input.setCustomValidity("");
        return true;
    } else {
        input.style.background = "#ffeaea";
        input.setCustomValidity("Enter a valid email or 10-digit contact number.");
        return false;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var userInput = document.querySelector('input[name="user_input"]');
    userInput.focus();
    userInput.addEventListener('input', function() { validateInput(this); });
});
</script>
</body>
</html>