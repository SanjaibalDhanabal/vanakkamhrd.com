
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


include("./includes/db_connect.php");
// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$designation = $_POST['designation'];
$company = $_POST['company'];
$location = $_POST['location'];

// Check if email already exists
$sql = "SELECT id FROM event_registration_covai_list WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Email already exists
    echo "<script>alert('This email is already registered'); window.history.back();</script>";
} else {
    // Insert data into database
    $sql = "INSERT INTO event_registration_covai_list (name, email, contact, designation, company, location) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $contact, $designation, $company, $location);

    if ($stmt->execute()) {
        // Send email
        $mail = new PHPMailer(true); // Passing `true` enables exceptions

        try {
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
            $mail->addAddress($email, $name); // Add a recipient

           // Content
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

            $mail->send();
            header("Location: sucessful_registration.php");
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$stmt->close();
$conn->close();
?>

























