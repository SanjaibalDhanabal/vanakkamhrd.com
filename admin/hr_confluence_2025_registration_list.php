<?php
// filepath: c:\xampp\htdocs\public_html\admin\hr_confluence_2025_registration_list.php

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
require_once('../includes/db_connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailer SMTP function
function sendMail($to, $subject, $message) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'support@vanakkamhrd.com';
        $mail->Password   = 'muwvugubxbrcyiqi';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('support@vanakkamhrd.com', 'HR Confluence 2025');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mail error to $to: " . $mail->ErrorInfo); // Add this line
        return false;
    }
}

// Handle Add User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $designation = $conn->real_escape_string($_POST['designation']);
    $company = $conn->real_escape_string($_POST['company']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $location = $conn->real_escape_string($_POST['location']);
    $how_know = $conn->real_escape_string($_POST['how_know']);
    $status = $conn->real_escape_string($_POST['status']);
    $sql = "INSERT INTO hr_confluence_2025_registrations (name, designation, company, email, contact, location, how_know, status, created_at)
            VALUES ('$name', '$designation', '$company', '$email', '$contact', '$location', '$how_know', '$status', NOW())";
    $conn->query($sql);

    // Send pending confirmation email
    if ($status === 'pending') {
        $subject = "Registration pending approval for HR Confluence 2025 (Coimbatore)";
        $message = '...'; // (keep your HTML email content here)
        sendMail($email, $subject, $message);
    }

    header("Location: hr_confluence_2025_registration_list.php?added=1");
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM hr_confluence_2025_registrations WHERE id=$id");
    header("Location: hr_confluence_2025_registration_list.php?deleted=1");
    exit;
}

// Handle Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $id = intval($_POST['edit_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $designation = $conn->real_escape_string($_POST['designation']);
    $company = $conn->real_escape_string($_POST['company']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $location = $conn->real_escape_string($_POST['location']);
    $how_know = $conn->real_escape_string($_POST['how_know']);
    $status = $conn->real_escape_string($_POST['status']);
    $sql = "UPDATE hr_confluence_2025_registrations SET
            name='$name', designation='$designation', company='$company', email='$email', contact='$contact',
            location='$location', how_know='$how_know', status='$status'
            WHERE id=$id";
    $conn->query($sql);
    header("Location: hr_confluence_2025_registration_list.php?edited=1");
    exit;
}

// Send confirmation or rejection email via button
if (isset($_GET['send']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $type = $_GET['send']; // 'confirm' or 'reject'
    $res = $conn->query("SELECT name, email FROM hr_confluence_2025_registrations WHERE id=$id");
    if ($row = $res->fetch_assoc()) {
        $name = $row['name'];
        $email = $row['email'];
        if ($type === 'confirm') {
            $subject = "Registration Confirmed for HR Confluence on 23 August 2025 (Saturday) at Coimbatore.";
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
                      Your Registration for <b>HR Confluence 2025 - Coimbatore</b> is <b>Confirmed</b>.
                    </p>
                    <div style="background:#eafaf1;padding:18px 12px;border-radius:8px;margin-bottom:18px;">
                      <span style="font-family:sans-serif;color:#222;font-size:15px;">Your Registration Name:</span><br>
                      <span style="font-size:22px;font-weight:bold;color:#27ae60;letter-spacing:2px;">'.htmlspecialchars($name).'</span>
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
                    <p style="font-family:sans-serif;color:#444;font-size:15px;margin:0 0 18px 0;">
                      <b>Address:</b> 33/3, Avinashi Rd, Lakshmi Mills, Coimbatore,Tamil Nadu 641018.
                    </p>
                    <p style="font-family:sans-serif;color:#444;font-size:15px;margin:0 0 10px 0;">
                      <b>Google Map:</b> <a href="https://maps.app.goo.gl/UEMiojTvsVobvRr26" target="_blank">https://maps.app.goo.gl/UEMiojTvsVobvRr26</a>
                    </p>
                    <div style="margin:24px 0 0 0;text-align:center;">
                      <a href="https://vanakkamhrd.com/events.php#agenda" target="_blank" style="display:inline-block;font-size:16px;padding:10px 28px;border-radius:30px;background:#12037f;color:#fff;text-decoration:none;margin-bottom:18px;">
                        View Agenda
                      </a>
                    </div>
                    <div style="font-family:sans-serif;color:#444;font-size:15px;text-align:left;max-width:400px;margin:24px auto 24px auto;">
                      <ul style="padding-left:18px;margin:0;">
                        <li>Registration check-in counters will be open by <b>09:00 AM.</b></li><br>
                        <li>You can walk to any registration check-in counter and kindly mention the registration name to collect your entry badge.</li><br>
                        <li>Without the badge, you will not be allowed to enter the main conference hall.</li><br>
                        <li>Request you to kindly occupy the seats in the main conference hall for the inauguration by <b>09:45 AM</b>.</li><br>
                        <li>A separate photobooth is arranged for photoshoots, so make it convenient to take photos and it will be updated on our event website after the event.</li><br>
                        <li>Kindly share your valuable bytes video feedback, at during the event.</li><br>
                        <li>For any support during the entire day, kindly reach out to the team, Vanakkam HRD.</li>
                      </ul>
                    </div>
                    <p style="font-family:sans-serif;color:#444;font-size:15px;margin:18px 0 18px 0;">
                      Our agenda includes thought-provoking sessions and networking opportunities with industry experts. This is a great chance to enhance your knowledge and forge valuable connections.
                    </p>
                    <p style="font-family:sans-serif;color:#444;font-size:15px;margin:18px 0 18px 0;">
                      <b>We look forward to welcoming you to Vanakkam HRD HR Confluence 2025 Coimbatore!</b>
                    </p>
                    <div style="margin:32px 0 0 0;text-align:center;">
                      <a href="https://www.facebook.com/vanakkamhrd" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/facebook.png" alt="Facebook" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                      <a href="https://www.youtube.com/@VanakkamHRD" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/youtube-play.png" alt="YouTube" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                      <a href="https://www.linkedin.com/company/vanakkam-hrd/" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/linkedin.png" alt="LinkedIn" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                      <a href="https://www.instagram.com/vanakkam_hrd/" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/instagram-new.png" alt="Instagram" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                    </div>
                    <p style="font-family:sans-serif;color:#888;font-size:13px;margin:24px 0 0 0;">
                      <b>Sincerely,</b><br>
                      <b>Vanakkam HRD Team</b><br>
                    </p>
                  </td>
                </tr>
              </table>
            </body>
            </html>
            ';
            $conn->query("UPDATE hr_confluence_2025_registrations SET status='approved' WHERE id=$id");
            header("Location: hr_confluence_2025_registration_list.php?single=confirm");
        } elseif ($type === 'reject') {
            $subject = "Registration not accepted for HR Confluence 2025 (Coimbatore)";
            $message =  '
            <!DOCTYPE html>
            <html>
            <head>
              <meta charset="UTF-8">
              <title>Registration Rejection</title>
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
                    <div style="font-family:sans-serif;color:#444;font-size:15px;text-align:left;max-width:400px;margin:24px auto 24px auto;">
                      <ul style="padding-left:18px;margin:0;">
                        <li>Just wanted to drop you a quick note about your registration for Vanakkam HRD Event HR Confluence 2025.</li><br>
                        <li>Unfortunately, it looks like we had to decline it this time around due to limited capacity and high demand.😔</li><br>
                        <li>But do not worry, we are always throwing fun mixers and events that you can be a part of in the future. We would love to have you join us at one of those!</li><br>
                        <li>If you have any questions or concerns, feel free to reach out. We are here to help.</li><br>
                        <li><b>Stay connected and talk soon! 🙌</b></li><br>
                      </ul>
                    </div>
                    <p style="font-family:sans-serif;color:#888;font-size:13px;margin:24px 0 0 0;">
                      <b>Sincerely,</b><br>
                      <b>Vanakkam HRD Team</b><br>
                    </p>
                  </td>
                </tr>
              </table>
            </body>
            </html>
            ';
            $conn->query("UPDATE hr_confluence_2025_registrations SET status='rejected' WHERE id=$id");
            header("Location: hr_confluence_2025_registration_list.php?single=reject");
        }
        sendMail($email, $subject, $message);
        exit;
    }
}

// Bulk send confirmation/rejection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bulk_action']) && isset($_POST['selected_ids'])) {
    $ids = array_map('intval', $_POST['selected_ids']);
    $type = $_POST['bulk_action']; // 'confirm' or 'reject'
    $idList = implode(',', $ids);
    $res = $conn->query("SELECT id, name, email FROM hr_confluence_2025_registrations WHERE id IN ($idList)");
    while ($row = $res->fetch_assoc()) {
        $name = $row['name'];
        $email = $row['email'];
        $id = $row['id'];
        if ($type === 'confirm') {
            $subject = "Registration Confirmed for HR Confluence on 23 August 2025 (Saturday) at Coimbatore.";
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
                      Your Registration for <b>HR Confluence 2025 - Coimbatore</b> is <b>Confirmed</b>.
                    </p>
                    <div style="background:#eafaf1;padding:18px 12px;border-radius:8px;margin-bottom:18px;">
                      <span style="font-family:sans-serif;color:#222;font-size:15px;">Your Registration Name:</span><br>
                      <span style="font-size:22px;font-weight:bold;color:#27ae60;letter-spacing:2px;">'.htmlspecialchars($name).'</span>
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
                    <p style="font-family:sans-serif;color:#444;font-size:15px;margin:0 0 18px 0;">
                      <b>Address:</b> 33/3, Avinashi Rd, Lakshmi Mills, Coimbatore,Tamil Nadu 641018.
                    </p>
                    <p style="font-family:sans-serif;color:#444;font-size:15px;margin:0 0 10px 0;">
                      <b>Google Map:</b> <a href="https://maps.app.goo.gl/UEMiojTvsVobvRr26" target="_blank">https://maps.app.goo.gl/UEMiojTvsVobvRr26</a>
                    </p>
                    <div style="margin:24px 0 0 0;text-align:center;">
                      <a href="https://vanakkamhrd.com/events.php#agenda" target="_blank" style="display:inline-block;font-size:16px;padding:10px 28px;border-radius:30px;background:#12037f;color:#fff;text-decoration:none;margin-bottom:18px;">
                        View Agenda
                      </a>
                    </div>
                    <div style="font-family:sans-serif;color:#444;font-size:15px;text-align:left;max-width:400px;margin:24px auto 24px auto;">
                      <ul style="padding-left:18px;margin:0;">
                        <li>Registration check-in counters will be open by <b>09:00 AM.</b></li><br>
                        <li>You can walk to any registration check-in counter and kindly mention the registration name to collect your entry badge.</li><br>
                        <li>Without the badge, you will not be allowed to enter the main conference hall.</li><br>
                        <li>Request you to kindly occupy the seats in the main conference hall for the inauguration by <b>09:45 AM</b>.</li><br>
                        <li>A separate photobooth is arranged for photoshoots, so make it convenient to take photos and it will be updated on our event website after the event.</li><br>
                        <li>Kindly share your valuable bytes video feedback, at during the event.</li><br>
                        <li>For any support during the entire day, kindly reach out to the team, Vanakkam HRD.</li>
                      </ul>
                    </div>
                    <p style="font-family:sans-serif;color:#444;font-size:15px;margin:18px 0 18px 0;">
                      Our agenda includes thought-provoking sessions and networking opportunities with industry experts. This is a great chance to enhance your knowledge and forge valuable connections.
                    </p>
                    <p style="font-family:sans-serif;color:#444;font-size:15px;margin:18px 0 18px 0;">
                      <b>We look forward to welcoming you to Vanakkam HRD HR Confluence 2025 Coimbatore!</b>
                    </p>
                    <div style="margin:32px 0 0 0;text-align:center;">
                      <a href="https://www.facebook.com/vanakkamhrd" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/facebook.png" alt="Facebook" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                      <a href="https://www.youtube.com/@VanakkamHRD" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/youtube-play.png" alt="YouTube" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                      <a href="https://www.linkedin.com/company/vanakkam-hrd/" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/linkedin.png" alt="LinkedIn" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                      <a href="https://www.instagram.com/vanakkam_hrd/" target="_blank" style="margin:0 8px;text-decoration:none;display:inline-block;">
                        <img src="https://img.icons8.com/color/48/000000/instagram-new.png" alt="Instagram" width="28" height="28" style="vertical-align:middle;border:none;display:inline-block;">
                      </a>
                    </div>
                    <p style="font-family:sans-serif;color:#888;font-size:13px;margin:24px 0 0 0;">
                      <b>Sincerely,</b><br>
                      <b>Vanakkam HRD Team</b><br>
                    </p>
                  </td>
                </tr>
              </table>
            </body>
            </html>
            ';
            $conn->query("UPDATE hr_confluence_2025_registrations SET status='approved' WHERE id=$id");
        } elseif ($type === 'reject') {
            $subject = "Registration not accepted for HR Confluence 2025 (Coimbatore)";
            $message = '
            <!DOCTYPE html>
            <html>
            <head>
              <meta charset="UTF-8">
              <title>Registration Rejection</title>
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
                    <div style="font-family:sans-serif;color:#444;font-size:15px;text-align:left;max-width:400px;margin:24px auto 24px auto;">
                      <ul style="padding-left:18px;margin:0;">
                        <li>Just wanted to drop you a quick note about your registration for Vanakkam HRD Event HR Confluence 2025.</li><br>
                        <li>Unfortunately, it looks like we had to decline it this time around due to limited capacity and high demand.😔</li><br>
                        <li>But do not worry, we are always throwing fun mixers and events that you can be a part of in the future. We would love to have you join us at one of those!</li><br>
                        <li>If you have any questions or concerns, feel free to reach out. We are here to help.</li><br>
                        <li><b>Stay connected and talk soon! 🙌</b></li><br>
                      </ul>
                    </div>
                    <p style="font-family:sans-serif;color:#888;font-size:13px;margin:24px 0 0 0;">
                      <b>Sincerely,</b><br>
                      <b>Vanakkam HRD Team</b><br>
                    </p>
                  </td>
                </tr>
              </table>
            </body>
            </html>
            ';
            $conn->query("UPDATE hr_confluence_2025_registrations SET status='rejected' WHERE id=$id");
        }
        sendMail($email, $subject, $message);
    }
    $bulkType = $type === 'confirm' ? 'confirm' : 'reject';
    header("Location: hr_confluence_2025_registration_list.php?bulk=$bulkType");
    exit;
}

// Pagination setup
$limit = 50;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Fetch counts
$count_total = $conn->query("SELECT COUNT(*) as c FROM hr_confluence_2025_registrations")->fetch_assoc()['c'];
$count_confirmed = $conn->query("SELECT COUNT(*) as c FROM hr_confluence_2025_registrations WHERE status='approved'")->fetch_assoc()['c'];
$count_rejected = $conn->query("SELECT COUNT(*) as c FROM hr_confluence_2025_registrations WHERE status='rejected'")->fetch_assoc()['c'];
$count_pending = $conn->query("SELECT COUNT(*) as c FROM hr_confluence_2025_registrations WHERE status='pending'")->fetch_assoc()['c'];
$total_pages = ceil($count_total / $limit);

// Fetch registrations for current page
$sql = "SELECT id, name, designation, company, email, contact, location, how_know, status, created_at 
        FROM hr_confluence_2025_registrations 
        ORDER BY created_at ASC 
        LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>HR Confluence 2025 - Registration List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
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
    </style>
</head>
<body>
<div class="container position-relative">
    <h2 style="text-align: center;">Registered Users - HR Confluence 2025</h2>
    <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addUserModal" title="Add User">
        <i class="fa fa-plus"></i>
    </button>
    <div class="d-flex gap-3 mb-3">
        <div class="badge bg-primary fs-6 px-3 py-2">Total Registered: <?= $count_total ?></div>
        <div class="badge bg-warning text-dark fs-6 px-3 py-2">Pending: <?= $count_pending ?></div>
        <div class="badge bg-success fs-6 px-3 py-2">Confirmed: <?= $count_confirmed ?></div>
        <div class="badge bg-danger fs-6 px-3 py-2">Rejected: <?= $count_rejected ?></div>
    </div>
    <div class="d-flex mb-2 gap-2 align-items-center">
        <input type="text" class="form-control w-auto" style="max-width:300px;" id="globalSearchInput" placeholder="Search..." onkeyup="globalSearchTable()">
        <a class="btn btn-outline-success ms-2" href="hr_confluence_2025_registration_export.php">
            <i class="fa fa-file-excel"></i> Export to Excel
        </a>
        <!-- <button class="btn btn-outline-danger ms-2" onclick="exportRegTableToPDF()">
            <i class="fa fa-file-pdf"></i> Export to PDF
        </button> -->
    </div>
    <form method="post" id="bulkForm">
    <input type="hidden" name="bulk_action" id="bulk_action" value="">
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle" id="regTable">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll" onclick="toggleAll(this)"></th>
                    <th>#</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Location</th>
                    <th>How did you know?</th>
                    <th>Status</th>
                    <th>Registered At</th>
                    <th>Send Confirmation</th>
                    <th>Send Rejection</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php $i = $offset + 1; while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php if ($row['status'] === 'pending'): ?>
                                <input type="checkbox" name="selected_ids[]" value="<?= $row['id'] ?>">
                            <?php endif; ?>
                        </td>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['designation']) ?></td>
                        <td><?= htmlspecialchars($row['company']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['contact']) ?></td>
                        <td><?= htmlspecialchars($row['location']) ?></td>
                        <td><?= htmlspecialchars($row['how_know']) ?></td>
                        <td>
                            <?php
                            $status = htmlspecialchars($row['status']);
                            $statusClass = '';
                            if ($status === 'pending') $statusClass = 'text-warning fw-bold';
                            elseif ($status === 'approved') $statusClass = 'text-success fw-bold';
                            elseif ($status === 'rejected') $statusClass = 'text-danger fw-bold';
                            ?>
                            <span class="<?= $statusClass ?>"><?= ucfirst($status) ?></span>
                        </td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                        <td>
                            <?php if ($row['status'] === 'pending'): ?>
                                <a href="#" class="btn btn-success btn-sm"
                                   onclick="return confirmAction('?send=confirm&id=<?= $row['id'] ?>','confirm')">
                                    <i class="fa fa-check"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($row['status'] === 'pending'): ?>
                                <a href="#" class="btn btn-danger btn-sm"
                                   onclick="return confirmAction('?send=reject&id=<?= $row['id'] ?>','reject')">
                                    <i class="fa fa-times"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" onclick="openEditModal(
                                <?= $row['id'] ?>,
                                '<?= htmlspecialchars(addslashes($row['name'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['designation'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['company'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['email'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['contact'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['location'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['how_know'])) ?>',
                                '<?= htmlspecialchars(addslashes($row['status'])) ?>'
                            )"><i class="fa fa-edit"></i></button>
                            <a href="#" class="btn btn-sm btn-danger"
                               onclick="return confirmDelete('?delete=<?= $row['id'] ?>')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="14" class="text-center">No registrations found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
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
    <div class="d-flex mt-3 gap-2">
        <button type="submit" name="bulk_action" value="confirm" class="btn btn-success btn-sm">
            <i class="fa fa-check"></i> Bulk Confirm
        </button>
        <button type="submit" name="bulk_action" value="reject" class="btn btn-danger btn-sm">
            <i class="fa fa-times"></i> Bulk Reject
        </button>
    </div>
    </form>
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
        <div class="mb-2"><input required name="name" class="form-control" placeholder="Name"></div>
        <div class="mb-2"><input required name="designation" class="form-control" placeholder="Designation"></div>
        <div class="mb-2"><input required name="company" class="form-control" placeholder="Company"></div>
        <div class="mb-2"><input required name="email" type="email" class="form-control" placeholder="Email"></div>
        <div class="mb-2"><input required name="contact" class="form-control" placeholder="Contact"></div>
        <div class="mb-2"><input required name="location" class="form-control" placeholder="Location"></div>
        <div class="mb-2"><input required name="how_know" class="form-control" placeholder="How did you know?"></div>
        <div class="mb-2">
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
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
        <div class="mb-2"><input required name="name" id="edit_name" class="form-control" placeholder="Name"></div>
        <div class="mb-2"><input required name="designation" id="edit_designation" class="form-control" placeholder="Designation"></div>
        <div class="mb-2"><input required name="company" id="edit_company" class="form-control" placeholder="Company"></div>
        <div class="mb-2"><input required name="email" id="edit_email" type="email" class="form-control" placeholder="Email"></div>
        <div class="mb-2"><input required name="contact" id="edit_contact" class="form-control" placeholder="Contact"></div>
        <div class="mb-2"><input required name="location" id="edit_location" class="form-control" placeholder="Location"></div>
        <div class="mb-2"><input required name="how_know" id="edit_how_know" class="form-control" placeholder="How did you know?"></div>
        <div class="mb-2">
            <select name="status" id="edit_status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
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
// SweetAlert for Add User Success
<?php if (isset($_GET['added']) && $_GET['added'] == 1): ?>
Swal.fire({icon: 'success', title: 'User Added!', showConfirmButton: false, timer: 1500});
<?php endif; ?>

// SweetAlert for Edit User Success
<?php if (isset($_GET['edited']) && $_GET['edited'] == 1): ?>
Swal.fire({icon: 'success', title: 'User Updated!', showConfirmButton: false, timer: 1500});
<?php endif; ?>

// SweetAlert for Delete Success
<?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
Swal.fire({icon: 'success', title: 'User Deleted!', showConfirmButton: false, timer: 1500});
<?php endif; ?>

// SweetAlert for Bulk Confirm/Reject
<?php if (isset($_GET['bulk']) && $_GET['bulk'] == 'confirm'): ?>
Swal.fire({icon: 'success', title: 'Bulk Confirmation Sent!', showConfirmButton: false, timer: 1500});
<?php elseif (isset($_GET['bulk']) && $_GET['bulk'] == 'reject'): ?>
Swal.fire({icon: 'success', title: 'Bulk Rejection Sent!', showConfirmButton: false, timer: 1500});
<?php endif; ?>

// SweetAlert for Single Confirm/Reject
<?php if (isset($_GET['single']) && $_GET['single'] == 'confirm'): ?>
Swal.fire({icon: 'success', title: 'Confirmation Sent!', showConfirmButton: false, timer: 1500});
<?php elseif (isset($_GET['single']) && $_GET['single'] == 'reject'): ?>
Swal.fire({icon: 'success', title: 'Rejection Sent!', showConfirmButton: false, timer: 1500});
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

// Confirm before single confirm/reject
function confirmAction(url, type) {
    Swal.fire({
        title: 'Are you sure?',
        text: type === 'confirm' ? "Send confirmation email?" : "Send rejection email?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: type === 'confirm' ? '#28a745' : '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
    return false;
}

// Confirm before bulk confirm/reject
document.querySelectorAll('button[name="bulk_action"]').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.getElementById('bulk_action').value = this.value;
    });
});
document.getElementById('bulkForm').onsubmit = function(e) {
    var action = document.getElementById('bulk_action').value;
    var checked = document.querySelectorAll('input[name="selected_ids[]"]:checked').length;
    if (!checked) {
        Swal.fire({icon: 'warning', title: 'No users selected!', showConfirmButton: false, timer: 1500});
        return false;
    }
    e.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        html: (action === 'confirm'
            ? "Send confirmation emails to <b>" + checked + "</b> selected user(s)?"
            : "Send rejection emails to <b>" + checked + "</b> selected user(s)?"),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: action === 'confirm' ? '#28a745' : '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            e.target.submit();
        }
    });
    return false;
};

// Global search for all columns except the first (checkbox) and last (action)
function globalSearchTable() {
    var input = document.getElementById('globalSearchInput');
    var filter = input.value.toUpperCase();
    var table = document.getElementById("regTable");
    var tr = table.getElementsByTagName("tr");
    for (var i = 1; i < tr.length; i++) {
        var tds = tr[i].getElementsByTagName("td");
        var found = false;
        for (var j = 1; j < tds.length - 1; j++) { // skip checkbox and action
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
function openEditModal(id, name, designation, company, email, contact, location, how_know, status) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_designation').value = designation;
    document.getElementById('edit_company').value = company;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_contact').value = contact;
    document.getElementById('edit_location').value = location;
    document.getElementById('edit_how_know').value = how_know;
    document.getElementById('edit_status').value = status;
    var editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
    editModal.show();
}

// Export Registration Table to PDF
function exportRegTableToPDF() {
    if (typeof window.jspdf === "undefined") {
        alert("jsPDF not loaded!");
        return;
    }
    const { jsPDF } = window.jspdf;
    var doc = new jsPDF('l', 'pt', 'a4');
    doc.text("Registered Users - HR Confluence 2025", 40, 40);
    var res = doc.autoTableHtmlToJson(document.getElementById("regTable"));
    doc.autoTable({
        head: [res.columns.map(col => col.title)],
        body: res.data,
        startY: 60,
        styles: { fontSize: 8 }
    });
    doc.save("registration_list.pdf");
}
</script>
</body>
</html>
<?php
$conn->close();
?>