<?php
    error_reporting(0);
    require './phpmailer/PHPMailerAutoload.php';
    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
		$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["phone"]);
        $subject = "Enquiry From Website";
        if(isset($_POST['comments'])){
            $message = trim($_POST["comments"]);
        }

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($phone) OR empty($subject) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "info@vanakkamhdc.com";

        // Set the email subject.
        $subject = "$subject";

        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Phone: $phone\n\n";
        $email_content .= "Subject: $subject\n\n";
        if(isset($_POST['comments'])){
            $email_content .= "Message:\n$message\n";
        }

        // Build the email headers.
        $email_headers = "From: $name <$email>";
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'info@vanakkamhdc.com';                     //SMTP username
            $mail->Password   = 'kieyjwwhuzuqpnma';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->setFrom($email, 'Vanakkam');
            $mail->addAddress('info@vanakkamhdc.com', 'Vanakkam');
            $mail->isHTML(true); 
            $mail->Subject =$subject;
            $mail->Body = $email_content;
            $mail->send();
            echo "Thank You! Your message has been sent successfully.";
        }
        catch (Exception $e) {
            echo "Oops! Something went wrong and we couldn't send your message.";
        }
    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        echo "There was a problem with your submission, please try again.";
    }

?>
