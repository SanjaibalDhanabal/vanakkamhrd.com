<?php
set_time_limit(500);
// Include PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer and QRCode libraries
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Include database connection file
include("../includes/db_connect.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get selected IDs
if (isset($_POST['selected_ids'])) {
    $selected_ids = $_POST['selected_ids'];
    
    // Prepare email
    $mail = new PHPMailer(true);
    try {
        $mail->Timeout = 500; // 5 minutes
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'info@vanakkamhrd.com'; // SMTP username
        $mail->Password = 'ifiiycepbjscbkna'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('info@vanakkamhrd.com', 'Vanakkam HRD');
        
        foreach ($selected_ids as $id) {
            $sql = "SELECT name, email FROM event_registration_covai_list WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $name = $row['name'];
                $email = $row['email'];
                
                // Add recipient
                $mail->addAddress($email);

                // Email content with personalized name
                $mail->isHTML(true);
               $mail->Subject = 'Registration Confirmed | HR Meet 2024 Event!';

                $mailContent = "
                <html>
                <body>
                <p style='text-transform: capitalize'><b>Dear " . htmlspecialchars($name) . ",</b></p>
                <p>I am elated to confirm your registration for Vanakkam HRD HR Meet 2024, on 21 September, Kasthuri Sreenivasan Trust Auditorium, Coimbatore!</p>
                <p>You can show this confirmation message at the event venue to access the HR Meet.</p>
                <p>Here are all the details you'll need:</p>
                <p><b>Theme: </b> 
                    'Future of Work: Trends and Strategies for HR'<br></p>
                    <p><strong>Date:</strong>
                    21 September 2024 (Saturday).<br></p>
                    <p><strong>Agenda for the event:</strong><br></p>
                    <p><b>09:30 AM</b> -  Registration<br></p>
                    <p><b>10:15 AM</b> -  Welcome Address<br></p>
                    <p><b>10:30 AM</b> - Keynote Speaker<br></p>
                    <p><b>11:15 AM</b> - Panel Discussion<br></p>
                    <p><b>01:45 PM</b> - Vote of Thanks - Followed by Networking Lunch <br>
                    </p>
                    <p>I'll be your point of contact for the event. So, please feel free to reach out to me.</p>
                    <p><b>Looking forward to meeting you at the event!</b></p>



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
               
                // Send email
                $mail->send();
                // Clear all recipients for the next iteration
                $mail->clearAddresses();
            }
        }
        echo 'Confirmation emails have been sent.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'No records selected.';
}

$conn->close();
?>