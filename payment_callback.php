<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once('includes/fpdf/fpdf.php');

// Function to generate the PDF poster
function generate_poster_pdf($bg_image, $user_photo, $name, $designation, $company, $output_pdf) {
    $pdf = new FPDF('P', 'pt', [2000, 2000]);
    $pdf->AddPage();

    // Background poster
    $pdf->Image($bg_image, 0, 0, 2000, 2000);

    // User photo inside the round (adjust x, y, w, h as needed)
    $pdf->Image($user_photo, 160, 700, 870, 870);

    // Text on the right side (adjust x, y as needed)
    $pdf->SetFont('Arial', 'B', 60);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetXY(1100, 930);
    $pdf->MultiCell(800, 80, $name, 0, 'L');
    $pdf->SetFont('Arial', '', 48);
    $pdf->SetXY(1100, 1030);
    $pdf->MultiCell(800, 60, $designation, 0, 'L');
    $pdf->SetXY(1100, 1130);
    $pdf->MultiCell(800, 60, $company, 0, 'L');

    $pdf->Output('F', $output_pdf);
    return $output_pdf;
}

// Email sending function
function send_email_with_attachments($to_email, $subject, $message, $attachments = []) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'support@vanakkamhrd.com';
        $mail->Password = 'muwvugubxbrcyiqi';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and Recipient
        $mail->setFrom('support@vanakkamhrd.com', 'Vanakkam HRD');
        $mail->addAddress($to_email);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = strip_tags($message);

        // Attachments
        foreach($attachments as $file) {
            if(file_exists($file)) {
                $mail->addAttachment($file);
            } else {
                error_log("Attachment missing: $file");
            }
        }

        $mail->send();
        error_log("Email sent to $to_email");
        return true;
    } catch (Exception $e) {
        error_log("Email sending failed: {$mail->ErrorInfo}");
        return false;
    }
}

$response = file_get_contents("php://input");
$res = json_decode($response, true);

$logFile = 'app.log';
file_put_contents($logFile, date('Y-m-d H:i:s') . $response . "\n", FILE_APPEND);

if (isset($res['payload']['order']['entity']['receipt'])) {
    $order_id = $res['payload']['order']['entity']['receipt'];
    $order_paid = strtolower($res['event']);
    $host = 'localhost';
    $dbname = 'vana_test';
    $username = 'vana_test';
    $password = 'Admin@123###';

    try {
        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Use the correct table for TN HR Summit 2025
        $stmt = $pdo->prepare("SELECT * FROM event_registers WHERE order_id = :order_id");
        $stmt->execute([':order_id' => $order_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            // DO NOT overwrite payment_status here!
            // $data["payment_status"] = 0;

            if (
                isset($res['payload']['order']['entity']['status']) &&
                strtolower($res['payload']['order']['entity']['status']) == 'paid' &&
                $order_paid == 'order.paid' &&
                $data["payment_status"] == "0"
            ) {
                $stmt = $pdo->prepare("UPDATE event_registers SET payment_status = :payment_status WHERE id = :id");
                $stmt->execute([
                    ':payment_status' => 1,
                    ':id' => $data["id"]
                ]);

                // Generate Invoice Number and Ticket ID
                $invoice_number = 1000 + intval($data["id"]);
                $ticket_id = 5000100 + intval($data["id"]);

                // Prepare company name for poster (break line if too long)
                $company = $data["company"];
                if(strlen($company) > 28) {
                    $company = wordwrap($company, 28, "\n", true);
                }

                // Generate Poster PDF (name, designation, company, photo)
                //$poster_bg = "temp/attending.png"; // Your blank poster template
                //$user_photo = "event_register/" . $data["photo"]; // Path to uploaded photo (ensure this is stored in DB)
                //$poster_pdf = "temp/poster_".$data["id"].".pdf";
                //generate_poster_pdf($poster_bg, $user_photo, $data["name"], $data["designation"], $company, $poster_pdf);

                // Generate Invoice PDF (fill name, email, company, invoice number, ticket id)
              	
              	$file_link="temp/".$data["id"].".jpg";
                $htmlFile="https://vanakkamhrd.com/event_poster.php?designation=".$data["designation"]."&company=".$data["company"]."&id=".$data["id"]."&name=".$data["name"];    
                exec('wkhtmltoimage --width 705 --height 705 --disable-smart-width --enable-local-file-access "'.$htmlFile.'" '.$file_link);
              
                $invoice_file = "temp/invoice_".$data["id"].".pdf";
                $invoice_url = "https://vanakkamhrd.com/invoice_template.php?name=".urlencode($data["name"])."&email=".urlencode($data["email"])."&company=".urlencode($data["company"])."&invoice_number=2025/".$invoice_number."&ticket_id=".$ticket_id;
                exec('wkhtmltopdf "'.$invoice_url.'" '.$invoice_file);

                // Email Content
                $logo_url = "https://vanakkamhrd.com/assets/images/logo.png";
                $message = '
                <div style="width:100%;background:#f6f7fb;padding:40px 0;">
                  <div style="max-width:600px;margin:0 auto;background:#fff;border-radius:12px;box-shadow:0 2px 12px #e5e7eb;padding:40px 32px 32px 32px;">
                    <div style="text-align:center;margin-bottom:24px;">
                      <img src="'.$logo_url.'" alt="Vanakkam HRD" style="max-width:180px;">
                    </div>
                    <h2 style="color:#12037f;font-family:Poppins,sans-serif;font-size:1.5rem;font-weight:700;text-align:center;margin:0 0 18px 0;">
                      Welcome to Annual TN HR Summit 2025!
                    </h2>
                    <p style="font-family:Poppins,sans-serif;font-size:1.1rem;color:#222;margin:0 0 18px 0;">
                      Dear <b>'.$data["name"].'</b>,
                    </p>
                    <p style="font-family:Poppins,sans-serif;font-size:1rem;color:#222;margin:0 0 18px 0;">
                      Vanakkam! 🙏
                    </p>
                    <p style="font-family:Poppins,sans-serif;font-size:1rem;color:#222;margin:0 0 18px 0;">
                      We\'re thrilled to confirm that your pass for <b>Annual TN HR Summit 2025!</b><br>
                      Join us on <b>December 20th, 2025</b>, at <b>Hilton Hotel, Chennai</b>, for a day of insightful discussions, networking, and learning.
                    </p>
                    <p style="font-family:Poppins,sans-serif;font-size:1rem;color:#222;margin:0 0 18px 0;">
                      Download the poster and share it on your LinkedIn profile, tagging <b>@Vanakkam HRD</b>.
                    </p>
                    <p style="font-family:Poppins,sans-serif;font-size:1rem;color:#222;margin:0 0 18px 0;">
                      Refer your HR colleagues and friends to join the Annual TN HR Summit.
                    </p>
                    <p style="font-family:Poppins,sans-serif;font-size:1rem;color:#222;margin:0 0 18px 0;">
                      <b>Note:</b> If your image isn\'t properly aligned on the poster, kindly share an updated photo, and we\'ll resend the revised poster.
                    </p>
                    <p style="font-family:Poppins,sans-serif;font-size:1rem;color:#222;margin:0 0 18px 0;">
                      Please find attached the invoice for your participation in the Annual TN HR Summit!
                    </p>
                    <div style="background:#f1f4fe;border-radius:8px;padding:18px 12px;margin:24px 0;text-align:center;">
                      <span style="font-size:1.1rem;font-family:Poppins,sans-serif;color:#12037f;font-weight:600;">
                        🗓 December 20th, 2025 / 9:00 AM<br>
                         Hilton Hotel, Chennai.
                      </span>
                    </div>
                    <p style="font-family:Poppins,sans-serif;font-size:1rem;color:#222;margin:0 0 18px 0;">
                      We look forward to seeing you there!
                    </p>
                    <div style="font-family:Poppins,sans-serif;font-size:1rem;color:#444;margin-top:32px;">
                      <b>Best regards,</b><br>
                      Team Vanakkam HRD,<br>
                      Mobile: 8248238229<br>
                      <a href="https://www.vanakkamhrd.com" style="color:#12037f;text-decoration:none;">www.vanakkamhrd.com</a>
                    </div>
                  </div>
                </div>
                ';

                // Send Email with both attachments (PDF poster and invoice)
                $sent = send_email_with_attachments(
                    $data["email"],
                    "Welcome to Annual TN HR Summit 2025!",
                    $message,
                    [$file_link, $invoice_file]
                );
                if(!$sent) {
                    $message=("Failed to send email to ".$data["email"]);
                    file_put_contents($logFile, date('Y-m-d H:i:s') . $message . "\n", FILE_APPEND);
                }
            }
        } else {
            $message=("No record found for order_id: " . $order_id);
            file_put_contents($logFile, date('Y-m-d H:i:s') . $message . "\n", FILE_APPEND);
        }
    } catch (PDOException $e) {
        $message=("DB Error: " . $e->getMessage());
        file_put_contents($logFile, date('Y-m-d H:i:s') . $message . "\n", FILE_APPEND);
    }
}
?>