

<?php
// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


// Database connection details
$host = 'localhost';
$dbname = 'vana_test';
$username = 'vana_test';
$password = 'Admin@123###';

// Create a database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $contact = htmlspecialchars(trim($_POST['contact']));
    $designation = htmlspecialchars(trim($_POST['designation']));
    $company = htmlspecialchars(trim($_POST['company']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $location = htmlspecialchars(trim($_POST['location']));

    // Validate required fields
    if (empty($name) || empty($email) || empty($contact) || empty($designation) || empty($company) || empty($gender) || empty($location)) {
        die("All fields are required.");
    }

    try {
        // Insert the data into the database
        $query = "INSERT INTO event_registration_bengaluru_list (name, email, contact, designation, company, gender, location) 
                  VALUES (:name, :email, :contact, :designation, :company, :gender, :location)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':designation', $designation);
        $stmt->bindParam(':company', $company);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':location', $location);

        if ($stmt->execute()) {
            // Send email to the user
            $mail = new PHPMailer(true);

    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'info@vanakkamhrd.com'; // Your SMTP username
        $mail->Password = 'ifiiycepbjscbkna'; // Your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient settings
        $mail->setFrom('info@vanakkamhrd.com', 'Vanakkam HRD');
        $mail->addAddress($email, $name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Registration pending approval for HR Conference 2025 (Bengaluru)';
        $mailContent = "
         <html>
    <body>
      <!-- Table with icons for Date and Location -->
    <table border='0' cellpadding='0' cellspacing='0' role='presentation' width='100%'>
  <tbody>
    <tr>
      <td align='left' style='font-size:0px;padding:0px;word-break:break-word'>
        <div style='font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,sans-serif;font-size:16px;line-height:1.6;text-align:left;color:#131517'>
          <table border='0' style='padding-bottom:4px;display:block' cellpadding='0' cellspacing='0' role='presentation' align='left'>
            <tbody>
              <tr>
                <td style='vertical-align:middle'>
                  <a style='display:flex;text-decoration:none' href='https://vanakkamhrd.com/' target='_blank'>
                    <img src='https://vanakkamhrd.com/assets/images/VHRD%20Logo.png' style='width:150px;height:50px;margin-top:10px;' class='CToWUd' data-bit='iit'>
                  </a>
                </td>
                <td style='vertical-align:middle;padding-left:8px'>
                  <a style='color:#737577!important;font-size:16px!important;line-height:1.5!important;text-decoration:none' href='https://vanakkamhrd.com/' target='_blank'>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </td>
    </tr>
    <tr>
      <td align='left' style='font-size:0px;padding:0px;word-break:break-word'>
        <div style='font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,sans-serif;font-size:16px;line-height:1.6;text-align:left;color:#131517'>
          <h1 style='margin-top:0;margin-bottom:4px;font-size:24px;line-height:32px'>
            <div style='font-weight:normal;color:#b3b5b7'>You are pending approval for</div>
            <b>HR Conference 2025 (Bengaluru) </b>
          </h1>
        </div>
      </td>
    </tr>
    <tr>
      <td align='center' style='font-size:0px;padding:0px;padding-top:16px;padding-bottom:16px;word-break:break-word'>
        <p style='border-top:solid 1px #ebeced;font-size:1px;margin:0px auto;width:100%'></p>
      </td>
    </tr>
    <tr>
      <td align='left' style='font-size:0px;padding:0px;word-break:break-word'>
        <div style='font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,sans-serif;font-size:16px;line-height:1.6;text-align:left;color:#131517'>
          <table>
            <tbody>
              <tr>
                <td style='padding-bottom:8px'>
                  <table border='0'>
                    <tbody>
                      <tr>
                        <td style='vertical-align:middle;width:40px;height:40px;padding:0'>
                          <table width='40' cellspacing='0' cellpadding='0' border='0' style='border-spacing:0;border-collapse:separate'>
                            <tbody>
                              <tr>
                                <td style='padding:0;margin:0;background-color:#eceded!important;border:1px solid #eceded;font-size:8px!important;line-height:2!important;border-top-right-radius:8px;border-top-left-radius:8px' valign='middle' align='center'>
                                  <span style='color:#737577!important;font-size:8px!important;line-height:2!important;font-weight:500'>FEB</span>
                                </td>
                              </tr>
                              <tr>
                                <td style='padding:0;margin:0;background-color:#ffffff;border:1px solid #eceded;border-bottom-right-radius:8px;border-bottom-left-radius:8px;font-size:16!important;line-height:1.5!important' valign='top' align='center'>
                                  <span style='font-size:16!important;line-height:1.5!important;font-weight:500;color:#737577'>22</span>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                        <td style='vertical-align:middle;padding-left:12px'>
                          <div>
                            <div style='font-size:16px;color:#131517;font-weight:500;overflow:hidden;text-overflow:ellipsis;white-space:nowrap'>Saturday, February 22, 2025</div>
                            <div style='font-size:14px;color:#737577;font-weight:400;overflow:hidden;text-overflow:ellipsis;white-space:nowrap'>09:30 AM to 02:00 PM</div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <table border='0'>
                    <tbody>
                      <tr>
                        <td style='vertical-align:middle;width:40px;height:40px;padding:0'>
                          <table border='0' style='padding:0;border-collapse:separate;border-spacing:0'>
                            <tbody>
                              <tr>
                                <td style='border:1px solid #eceded;vertical-align:middle;width:40px;height:40px;border-radius:8px' align='center'>
                                  <img style='display:block' src='https://ci3.googleusercontent.com/meips/ADKq_NYSDVgoUCKIh4IOkr76310Ncvhl6qe-aAijtDuH2A5uhRbdpQRkangyIocVkZPAHJo5bgW5k4yVayCJULLufAbAyKDudntKpfxlVKJkHTyMXInrbaGzW_BXwGyj9vG6pzKWOK7AVeh3Xr1m3wvta8hA79H5vOU_aAokMV-hHVLdZipwmu2wAIeLF7YDHH-vPOa3sSkYcXBb1hATubY=s0-d-e1-ft#https://cdn.lu.ma/cdn-cgi/image/format=auto,fit=cover,dpr=2,quality=75,width=40,height=40/misc/3k/95610a7f-2391-4002-9779-a1e9bfb7216c' width='20' height='20' class='CToWUd' data-bit='iit'>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                        <td style='vertical-align:middle;padding-left:12px'>
                          <div style='font-size:16px;color:#131517;font-weight:500'>Hotel Grand Mercure, Bengaluru (Near Gopalan Mall).</div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </td>
    </tr>
    <tr>
      <td align='center' style='font-size:0px;padding:0px;padding-top:16px;padding-bottom:16px;word-break:break-word'>
        <p style='border-top:solid 1px #ebeced;font-size:1px;margin:0px auto;width:100%'></p>
      </td>
    </tr>
  </tbody>
</table>


        <p style='text-transform: capitalize'><b>Dear $name,</b></p>
        <p>We wanted to reach out to you regarding your interest in Vanakkam HRD event. Please note that this event is by invitation only.</p>
        <p>Your registration is currently pending approval and we will notify you of your status as soon as possible. In the meantime, if you have any questions or concerns, please don't hesitate to reach out to us.</p>


        <div dir='ltr' class='gmail_signature' data-smartmail='gmail_signature'>
            <div dir='ltr'>
                <b><font color='#351c75' face='comic sans ms, sans-serif'>Sincerely,</font></b>
                <div><font color='#0c343d' face='comic sans ms, sans-serif'>Rajeshwaran P</font></div>
                <div><font color='#0c343d' face='comic sans ms, sans-serif'>Founder</font></div>
                <div><font color='#0c343d' face='comic sans ms, sans-serif'>Mobile: 9751229398</font></div>
                <div><font color='#0c343d' face='comic sans ms, sans-serif'>
                    <a href='http://www.vanakkamhrd.com' target='_blank'>www.vanakkamhrd.com</a>
                </font></div>
                <div><font color='#0c343d' face='comic sans ms, sans-serif'><br></font></div>
                <div><img width='100' height='27' src='https://vanakkamhrd.com/assets/images/VHRD%20Logo.png' class='CToWUd'></div>
            </div>
        </div>
    </body>
    </html>
                ";
    
                $mail->Body = $mailContent;
                // Send the email
                $mail->send();
                header('Location: sucessful_registration.php');
                exit(); // Ensure no further code is executed
                
            } catch (Exception $e) {
                echo "Registration successful, but the email could not be sent. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Failed to register. Please try again.";
        }
    } catch (PDOException $e) {
        // Handle unique constraint violation for email
        if ($e->getCode() == 23000) {
            echo "The email address is already registered.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>



