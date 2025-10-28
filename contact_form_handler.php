<?php
include("./includes/db_connect.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $contact = htmlspecialchars($_POST['contact']);
    $message = htmlspecialchars($_POST['message']);

    // Insert form data into the database
    $sql = "INSERT INTO contact_form_submissions (name, email, contact, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $name, $email, $contact, $message);

    if ($stmt->execute()) {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();                                           // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';             // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                  // Enable SMTP authentication
            $mail->Username   = 'info@vanakkamhrd.com';              // SMTP username
            $mail->Password   = 'ifiiycepbjscbkna';                 // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        // Enable TLS encryption
            $mail->Port       = 587;                                   // TCP port to connect to

            // Recipients
            $mail->setFrom('info@vanakkamhrd.com', 'Vanakkam HRD');  // Your website email
            $mail->addAddress('info@vanakkamhrd.com', 'Vanakkam HRD');     // Add a recipient (Admin email)

            // Content
            $mail->isHTML(true);                                       // Set email format to HTML
            $mail->Subject = 'New Contact Form Submission';
            $mail->Body    = "
                <h3>Contact Form Submission</h3>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Contact:</strong> {$contact}</p>
                <p><strong>Message:</strong> {$message}</p>
            ";

            // Send email
            if ($mail->send()) {
                echo '<script type="text/javascript">
                        alert("Message has been sent to the Admin.");
                         window.history.back(); // Redirect back to the form page
                      </script>';
            } else {
                echo '<script type="text/javascript">
                        alert("Message could not be sent. Please try again later.");
                        window.history.back(); // Redirect back to the form page
                      </script>';
            }

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    } else {
        echo '<script type="text/javascript">
                alert("There was an error saving the data to the database.");
              </script>';
    }

    $stmt->close();
    $conn->close();

} else {
    echo 'Invalid request method';
}
?>
