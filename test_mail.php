<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    function send_email($to_email, $subject, $message,$file_link) {
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
            $mail->addAttachment($file_link);
            // Send Email
            return $mail->send();
        } catch (Exception $e) {
            echo ("Email sending failed: {$mail->ErrorInfo}");
            return false;
        }
    }
    


                    $message='<div style="padding: 10px;">
                                    <p>Please download the poster and share it on your LinkedIn profile, <strong>tagging Vanakkam HRD.</strong></p>
                                    <p>Lets connect, collaborate, and celebrate the future of HR!</p> 
                                    <p>Looking forward to meeting you all at the event on <strong>July 5th, 2025, at Chennai Trade Center.</strong>
                                    <p><strong>See you there!</strong> </p>
                            </div>';
                    
                    $file_link="temp/1.jpg";
                    $htmlFile="https://vanakkamhrd.com/event_poster.php?designation=test&company=comp&id=1&name=siva";
                   
                    exec('wkhtmltoimage --width 705 --height 705 --disable-smart-width --enable-local-file-access "'.$htmlFile.'" '.$file_link);

                    send_email("msivarajacse@gmail.com","INDIA'S LARGEST - HR FESTIVAL 2025! ",$message,$file_link);
                
?>