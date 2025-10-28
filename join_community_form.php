<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
require_once('includes/fpdf/fpdf.php');
require_once('includes/db_connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$success = false;
$error = '';

// Helper: Make circular image properly centered
function makeCircularImage($srcPath, $destPath, $size = 300) {
    $src = null;
    $ext = strtolower(pathinfo($srcPath, PATHINFO_EXTENSION));
    if ($ext == 'jpg' || $ext == 'jpeg') $src = imagecreatefromjpeg($srcPath);
    elseif ($ext == 'png') $src = imagecreatefrompng($srcPath);
    elseif ($ext == 'webp') $src = imagecreatefromwebp($srcPath);
    else return false;

    $w = imagesx($src);
    $h = imagesy($src);

    // Create square canvas
    $square = imagecreatetruecolor($size, $size);
    imagesavealpha($square, true);
    $trans = imagecolorallocatealpha($square, 0, 0, 0, 127);
    imagefill($square, 0, 0, $trans);

    // Scale proportionally
    $scale = min($size / $w, $size / $h);
    $new_w = $w * $scale;
    $new_h = $h * $scale;

    // Center horizontally and shift vertically to show chin
    $dst_x = ($size - $new_w) / 2;
    $dst_y = ($size - $new_h) / 2 + 10;

    imagecopyresampled($square, $src, $dst_x, $dst_y, 0, 0, $new_w, $new_h, $w, $h);

    // Create circular mask
    $mask = imagecreatetruecolor($size, $size);
    imagesavealpha($mask, true);
    imagefill($mask, 0, 0, $trans);
    $circle = imagecolorallocatealpha($mask, 0, 0, 0, 0);
    imagefilledellipse($mask, $size/2, $size/2, $size, $size, $circle);

    // Flatten bottom area slightly
    $flat_height = 30; // amount to flatten bottom
    imagefilledrectangle($mask, 0, $size - $flat_height, $size, $size, $circle);

    // Apply mask
    for ($x = 0; $x < $size; $x++) {
        for ($y = 0; $y < $size; $y++) {
            $alpha = (imagecolorat($mask, $x, $y) & 0x7F000000) >> 24;
            if ($alpha == 127) {
                imagesetpixel($square, $x, $y, $trans);
            }
        }
    }

    imagepng($square, $destPath);
    imagedestroy($src);
    imagedestroy($square);
    imagedestroy($mask);
    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    $name = $_POST['name'];
    $personal_email = $_POST['personal_email'];
    $official_email = $_POST['official_email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $designation = $_POST['designation'];
    $company = $_POST['company'];
    $industry = $_POST['industry'];
    $linkedin = $_POST['linkedin'];
    $state = $_POST['state'];
    $city = $_POST['city'];

    $imgPath = '';
    $circleImgPath = '';
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp'];
        if (in_array($ext, $allowed)) {
            $imgPath = 'uploads/' . uniqid('profile_') . '.' . $ext;
            move_uploaded_file($_FILES['profile']['tmp_name'], $imgPath);

            $circleImgPath = 'uploads/' . uniqid('circle_') . '.png';
            makeCircularImage($imgPath, $circleImgPath, 300);
        }
    }

    // Save to DB
    $query = "INSERT INTO community_member(name, personal_email, official_email, contact, gender, designation, company, industry, linkedin, images, state, city) 
              VALUES ('$name', '$personal_email','$official_email','$contact','$gender','$designation','$company','$industry','$linkedin','$imgPath','$state','$city')";
    mysqli_query($conn, $query);

    // Generate PDF
    $pdf = new FPDF('L', 'pt', [1140, 678]);
    $pdf->AddPage();

    $bgPath = 'assets/images/bggposter.jpeg';
    if (file_exists($bgPath)) {
        $pdf->Image($bgPath, 0, 0, 1140, 678);
    } else {
        $pdf->SetFillColor(44, 0, 74);
        $pdf->Rect(0, 0, 1140, 678, 'F');
    }

    // Profile photo
    $circleX = 110;
    $circleY = 130;
    $circleSize = 300;
    if ($circleImgPath && file_exists($circleImgPath)) {
        $pdf->Image($circleImgPath, $circleX, $circleY, $circleSize, $circleSize);
    }

    // Logo
    $logoPath = 'assets/images/whitelogo.png';
    if (file_exists($logoPath)) {
        $pdf->Image($logoPath, 670, 60, 200);
    }

    // Texts
    $pdf->SetFont('Times', 'I', 48);
    $pdf->SetTextColor(255, 165, 0);
    $pdf->SetXY(600, 205);
    $pdf->Cell(0, 55, 'Proud Member Of', 0, 1, 'L');

    $pdf->SetFont('Times', 'B', 38);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetXY(600, 275);
    $pdf->Cell(0, 40, $name, 0, 1, 'L');

    $pdf->SetFont('Arial', 'I', 30);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetXY(600, 325);
    $pdf->Cell(0, 35, $designation, 0, 1, 'L');

    $pdf->SetFont('Arial', 'I', 30);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetXY(600, 375);
    $pdf->Cell(0, 35, $company, 0, 1, 'L');

    $pdf->SetFont('Arial', 'I', 18);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetXY(80, 600);
    $pdf->Cell(0, 20, 'www.vanakkamhrd.com', 0, 1, 'L');

    $iconY = 600;
    $iconX = 800;
    $iconGap = 20;
    $iconSize = 40;

    $pdf->SetFont('Arial', 'I', 18);
    $pdf->SetTextColor(255,255,255);
    $followUsWidth = $iconGap * 3 + $iconSize * 4;
    $pdf->SetXY($iconX, $iconY-55);
    $pdf->Cell($followUsWidth, 30, 'Follow Us!', 0, 1, 'C');

    $pdf->Image('assets/images/w1-removebg-preview.png', $iconX, $iconY, $iconSize);
    $pdf->Image('assets/images/w2-removebg-preview.png', $iconX+$iconGap+$iconSize, $iconY, $iconSize);
    $pdf->Image('assets/images/w3-removebg-preview.png', $iconX+2*($iconGap+$iconSize), $iconY, $iconSize);
    $pdf->Image('assets/images/w5-removebg-preview.png', $iconX+3*($iconGap+$iconSize), $iconY, $iconSize);

    $pdfFile = tempnam(sys_get_temp_dir(), 'poster_') . '.pdf';
    $pdf->Output('F', $pdfFile);

    // Email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'support@vanakkamhrd.com';
        $mail->Password   = 'muwvugubxbrcyiqi';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->setFrom('support@vanakkamhrd.com', 'Vanakkam HRD');
        $mail->addAddress($official_email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'Thank You for Joining Our Community!';
        $mail->Body = "<html>
    <body>

        <p style='text-transform: capitalize'><b>Dear $name,</b></p>
        <p>Thank you for joining our community! We're thrilled to have you with us and look forward to your active participation.</p>
        <p>Your support helps us continue to grow and create opportunities for everyone involved. As a member, you’ll be among the first to hear about our latest events, news, and initiatives.</p>
        <ul><b>Stay Connected:</b>
        <li>Engage with other members.</li>
        <li>Attend upcoming events.</li>
        <li>Share your ideas and feedback.</li>
        </ul>
        <p>If you have any questions or need assistance, feel free to reach out to us.</p>
        <p>Once again, welcome to our community. We’re excited to embark on this journey together!</p>


        <div dir='ltr' class='gmail_signature' data-smartmail='gmail_signature'>
            <div dir='ltr'>
                <b><font color='#351c75' face='comic sans ms, sans-serif'>Sincerely,</font></b>
                <div><font color='#0c343d' face='comic sans ms, sans-serif'>Vanakkam HRD Team</font></div>
                <div><font color='#0c343d' face='comic sans ms, sans-serif'>
                    <a href='http://www.vanakkamhrd.com' target='_blank'>www.vanakkamhrd.com</a>
                </font></div>
                <div><font color='#0c343d' face='comic sans ms, sans-serif'><br></font></div>
                <div><img width='100' height='27' src='https://vanakkamhrd.com/assets/images/VHRD%20Logo.png' class='CToWUd'></div>
            </div>
        </div>
    </body>
    </html>";
        $mail->addAttachment($pdfFile, 'Community_Poster.pdf');
        $mail->send();

        unlink($pdfFile);
        if ($circleImgPath && file_exists($circleImgPath)) unlink($circleImgPath);
        if ($imgPath && file_exists($imgPath)) unlink($imgPath);
        $success = true;
    } catch (Exception $e) {
        $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Join Community</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: url(assets/images/blue1.png); }
        .card { border-radius: 10px; box-shadow: 10px 10px 10px 10px rgba(0, 0, 0, 0.3);}
        .card-header { border-bottom: none; border-radius: 10px 10px 0 0;}
        .card-body { padding: 2rem;}
        .form-control { border-radius: 5px; border-color: #ced4da; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);}
        .form-control:focus { border-color: #007bff; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075), 0 0 0 0.2rem rgba(38, 143, 255, 0.25);}
        .btn-primary { border-radius: 5px; padding: 0.75rem 1.25rem; font-size: 1.125rem;}
        .form-group label { font-weight: bold;}
        .card1 img{ height: 80px; width: auto;}
        .card-body .form-control, .form-control-file { height: 50px;}
        @media (max-width: 606px) {
            .card { width: 80vw; margin-left: 23px; border-radius: 10px; box-shadow: 10px 10px 10px 10px rgba(0, 0, 0, 0.3);}
        }
    </style>
</head>
<body>
    <?php if ($success): ?>
        <div class="alert alert-success text-center mt-4">Your form was submitted and emailed successfully!</div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger text-center mt-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card1 mt-4 text-center text-primary">
                        <img src="assets/images/VHRD Logo.png">
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="personal_email">Personal Email</label>
                                        <input type="email" class="form-control" id="personal_email" name="personal_email" placeholder="Personal Email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="official_email">Official Email</label>
                                        <input type="email" class="form-control" id="official_email" name="official_email" placeholder="Official Email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact Number</label>
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company">Company</label>
                                        <input type="text" class="form-control" id="company" name="company" placeholder="Company" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="industry">Nature of Industry</label>
                                <select class="form-control" id="industry" name="industry" required>
                                    <option value="">Select Industry</option>
                                    <option value="corporate">Corporate</option>
                                    <option value="educational">Educational</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="linkedin">LinkedIn URL</label>
                                <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="LinkedIn URL" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Your Image</label>
                                <input type="file" class="form-control-file" id="image" name="profile" accept=".jpg, .jpeg, .png, .webp" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" id="state" name="state" placeholder="State" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="upload" class="btn btn-primary mt-3 mb-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
