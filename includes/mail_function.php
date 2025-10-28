<?php
set_time_limit(500);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function send_email($to_email, $subject, $message) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
         $mail->Timeout = 500; // 5 minutes
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'info@vanakkamhrd.com'; // Replace with your email
        $mail->Password = 'ifiiycepbjscbkna'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port = 587;

        // Sender and Recipient
        $mail->setFrom('info@vanakkamhrd.com', 'Vanakkam HRD'); // Change to your email
        $mail->addAddress($to_email);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = strip_tags($message);

        // Send Email
        return $mail->send();
    } catch (Exception $e) {
        error_log("Email sending failed: {$mail->ErrorInfo}");
        return false;
    }
}

// send_email("msivarajacse@gmail.com","Test","Test");
?>


