<?php
// Handle form submission

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$show_success = false;
$show_duplicate = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['final_submit'])) {
    $conn = new mysqli('localhost', 'vana_test', 'Admin@123###', 'vana_test'); // Change DB details
    if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);

    // Check for duplicate registration (by email or contact)
    $check = $conn->query("SELECT id FROM hr_confluence_2025_registrations WHERE email='$email' OR contact='$contact' LIMIT 1");
    if ($check && $check->num_rows > 0) {
        $show_duplicate = true;
    } else {
        $name = $conn->real_escape_string($_POST['name']);
        $designation = $conn->real_escape_string($_POST['designation']);
        $company = $conn->real_escape_string($_POST['company']);
        $location = $conn->real_escape_string($_POST['location']);
        $how_know = $conn->real_escape_string($_POST['how_know']);
        $sql = "INSERT INTO hr_confluence_2025_registrations (name, designation, company, email, contact, location, how_know, status, created_at)
                VALUES ('$name', '$designation', '$company', '$email', '$contact', '$location', '$how_know', 'pending', NOW())";
        $conn->query($sql);

    $to = $email;
    $subject = "Registration pending approval for HR Confluence 2025 (Coimbatore)";
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
                    <h2 style="font-family:sans-serif;color:#222;margin:0 0 12px 0;">Dear '.htmlspecialchars($name).'</h2>
                    <p style="font-family:sans-serif;color:#444;font-size:16px;margin:0 0 18px 0;">
                      <b>Greetings from Vanakkam HRD!</b>
                    </p>
                    <p style="font-family:sans-serif;color:#444;font-size:16px;margin:0 0 18px 0;">
                      We wanted to reach out to you regarding your interest in <b>Vanakkam HRD HR Confluence 2025.</b>
                    </p>
                    <div style="font-family:sans-serif;color:#444;font-size:15px;text-align:left;max-width:400px;margin:24px auto 24px auto;">
                      <ul style="padding-left:18px;margin:0;">
                        <li>Your registration is currently being processed. You will receive a confirmation of your status at least one week before to the event.</li><br>
                      </ul>
                    </div>
                    <!-- Event Date & Location Block Start -->
                    <table cellpadding="0" cellspacing="0" style="margin:24px 0 0 0;">
                        <tr>
                            <!-- Date Block -->
                            <td valign="top" align="center" style="padding-right:18px;">
                            <div style="font-family:sans-serif;background:#f4f6fb;border-radius:5px;padding:8px 0 4px 0;width:48px;text-align:center;">
                                <div style="font-family:sans-serif;color:#1abc9c;font-size:1rem;font-weight:600;letter-spacing:1px;">AUG</div>
                                <div style="font-family:sans-serif;color:#23294a;font-size:1.3rem;font-weight:600;line-height:1.1;">23</div>
                            </div>
                            </td>
                            <!-- Date/Time Content -->
                            <td valign="top" style="padding-bottom:6px;">
                            <div style="font-family:sans-serif;color:#23294a;font-size:1.08rem;font-weight:600;">
                                Saturday, August 23, 2025
                            </div>
                            <div style="font-family:sans-serif;color:#888;font-size:0.98rem;margin:2px 0 0 0;">
                                09:30 AM to 01:30 PM
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <!-- Location Icon -->
                            <td valign="top" align="center" style="padding-top:10px;padding-right:18px;">
                            <div style="background:#f4f6fb;border-radius:5px;padding:7px 0 3px 0;width:48px;text-align:center;">
                                <img src="https://img.icons8.com/ios-filled/22/12037f/marker.png" alt="Location" style="vertical-align:middle;">
                            </div>
                            </td>
                            <!-- Location Content -->
                            <td valign="middle" style="padding-top:10px;">
                            <div style="font-family:sans-serif;color:#23294a;font-size:1.08rem;font-weight:600;">
                                Zone by The Park Hotel, Coimbatore
                            </div>
                            </td>
                        </tr>
                        </table>
                    <!-- Event Date & Location Block End -->
                    <div style="margin:32px 0 0 0;text-align:center;">
                      <a href="https://facebook.com/vanakkamhrd" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/facebook.png" alt="Facebook" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                      <a href="https://www.youtube.com/@vanakkamhrd" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/youtube-play.png" alt="YouTube" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                      <a href="https://www.linkedin.com/company/vanakkam-hrd/" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/linkedin.png" alt="LinkedIn" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                      <a href="https://www.instagram.com/vanakkam_hrd?igsh=MW1oNGlwaTE4Z3F5OQ==" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
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
            $mail->addAddress($to, $name);
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $message;

            $mail->send();
            $show_success = true;
        } catch (Exception $e) {
            // Optionally, handle error
        }
    }
}
?>

<?php include 'includes/header.php'; // Include your header markup ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
<style>
body { font-family: 'Poppins', Arial, sans-serif; background: #f9fafb; margin:0; }
.form-container {
    max-width: 430px;
    margin: 40px auto 60px auto;
    background: #fff;
    padding: 32px 18px 28px 18px;
    border-radius: 18px;
    box-shadow: 0 2px 16px rgba(255,92,147,0.10);
}
.form-logo {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
}
.form-logo img {
    width: 120px;
    height: auto;
}
.form-heading {
    text-align: center;
    font-size: 1.7rem;
    font-weight: 800;
    color: #12037f;
    margin-bottom: 8px;
    letter-spacing: 1px;
}
.form-subheading {
    text-align: center;
    font-size: 1.1rem;
    font-weight: 600;
    color: #ff5c93;
    margin-bottom: 18px;
    letter-spacing: 0.5px;
}
.reg-form label {
    display: block;
    margin-top: 14px;
    font-weight: 600;
    color: #12037f;
}
.reg-form input, .reg-form select {
    width: 100%;
    padding: 10px 10px;
    margin-top: 4px;
    border-radius: 6px;
    border: 1.5px solid #ccc;
    font-size: 1rem;
    background: #f9fafb;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    outline: none;
}
.reg-form input:focus, .reg-form select:focus {
    border-color: #ff5c93;
    box-shadow: 0 0 0 2px #ffe0ed;
    background: #fff;
}
.eventup-hero-btn,
.reg-form button {
    margin-top: 22px;
    width: 100%;
    background: linear-gradient(90deg, #ff5c93 0%, #ff3e7a 100%);
    color: #fff;
    border: none;
    padding: 13px 0;
    border-radius: 30px;
    font-size: 1.08rem;
    font-weight: 800;
    letter-spacing: 1px;
    cursor: pointer;
    transition: background 0.2s, box-shadow 0.2s;
    box-shadow: 0 4px 16px rgba(255,92,147,0.13);
    text-transform: uppercase;
}
.eventup-hero-btn:hover,
.reg-form button:hover {
    background: linear-gradient(90deg, #12037f 0%, #ff5c93 100%);
}
@media (max-width: 600px) {
    .form-container { max-width: 98vw; padding: 18px 4vw 18px 4vw; border-radius: 10px;}
    .form-logo img { width: 80px; }
    .form-heading { font-size: 1.15rem; }
    .form-subheading { font-size: 0.98rem; }
}
</style>
<?php if ($show_duplicate): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'warning',
      title: 'Already Registered!',
      text: 'You have already registered for this event.',
      confirmButtonColor: '#ff5c93',
      allowOutsideClick: false,
      allowEscapeKey: false
    }).then(function() {
      window.location.href = 'events.php';
    });
  });
</script>
<?php elseif ($show_success): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Thank you for registering!',
      text: 'Please check your email!',
      confirmButtonColor: '#ff5c93',
      allowOutsideClick: false,
      allowEscapeKey: false
    }).then(function() {
      window.location.href = 'events.php';
    });
  });
</script>

<?php else: ?>
<div class="form-container">
    <div class="form-heading">HR Confluence 2025</div>
    <div class="form-subheading">Registration Form</div>
    <form class="reg-form" id="regForm" method="post" action="" autocomplete="on">
        <label>Name</label>
        <input type="text" name="name" required>
        <label>Designation</label>
        <input type="text" name="designation" required>
        <label>Company</label>
        <input type="text" name="company" required>
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Contact</label>
        <input type="text" name="contact" required>
        <label>Location</label>
        <input type="text" name="location" required>
        <label>How did you know?</label>
        <select name="how_know" required>
            <option value="">Select</option>
            <option value="Website">Website</option>
            <option value="SocialMedia">Social Media</option>
            <option value="LinkedIn">LinkedIn</option>
            <option value="Other">Other</option>
        </select>
        <button type="submit" name="final_submit" value="1" class="eventup-hero-btn">Submit</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
<script>
function validateContact(input) {
    const val = input.value.trim();
    if (!/^\d{10}$/.test(val)) {
        input.style.background = "#ffeaea";
        if (val.length > 0 && val.length !== 10) {
            input.setCustomValidity("Contact number must be exactly 10 digits. You entered " + val.length + " digits.");
        } else {
            input.setCustomValidity("Contact number must be exactly 10 digits.");
        }
        return false;
    } else {
        input.style.background = "";
        input.setCustomValidity("");
        return true;
    }
}

function validateEmail(input) {
    const val = input.value.trim();
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
        input.style.background = "#ffeaea";
        input.setCustomValidity("Please enter a valid email address.");
        return false;
    } else {
        input.style.background = "";
        input.setCustomValidity("");
        return true;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var contactInput = document.querySelector('input[name="contact"]');
    var emailInput = document.querySelector('input[name="email"]');
    contactInput.addEventListener('input', function() { validateContact(this); });
    emailInput.addEventListener('input', function() { validateEmail(this); });
});
</script>
<?php endif; ?>
<?php include 'includes/footer.php'; // Include your footer markup ?>