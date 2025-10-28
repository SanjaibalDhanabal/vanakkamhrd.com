<?php

include("./includes/db_connect.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['upload']))
{
    $img_loc=$_FILES['profile']['tmp_name'];
    $img_name=$_FILES['profile']['name'];

    $uname=$_POST['name'];
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

    $img_size=$_FILES['profile']['size']/(1024*1024);

    $unique_id = uniqid(); // Generates a unique ID based on the current time in microseconds
    $timestamp = time(); // Gets the current timestamp
    $img_ext = pathinfo($img_name, PATHINFO_EXTENSION); // Get the image extension
    $img_des = "uploads/".$uname."_".$timestamp."_".$unique_id.".".$img_ext; // Generates the unique image name
    

    // Check for valid image or PDF extension
    if(($img_ext != 'jpg') && ($img_ext != 'png') && ($img_ext != 'jpeg') && ($img_ext != 'webp') && ($img_ext != 'pdf'))
    {
        echo "<script>alert('Invalid File Extension');</script>";
        exit();
    }

    // Check for file size limit
    if($img_size > 3)
    {
        echo "<script>alert('File size is greater than 3MB');</script>";
        exit();
    }

    $query="INSERT INTO community_member(name, personal_email, official_email, contact, gender, designation, company, industry, linkedin, images, state, city) VALUES ('$uname', '$personal_email','$official_email','$contact','$gender','$designation','$company','$industry','$linkedin','$img_des','$state','$city')";

    if(mysqli_query($conn,$query))
    {
        move_uploaded_file($img_loc,$img_des);
        // Create an instance; passing true enables exceptions
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = 'smtp.gmail.com';
            $mail->Username = 'info@vanakkamhrd.com';
            $mail->Password = 'ifiiycepbjscbkna';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('info@vanakkamhrd.com', 'Vanakkam HRD');
            $mail->addAddress($official_email, $uname); // Send confirmation email to the user's email address

             
             $mail->isHTML(true); // Set email format to HTML
             $mail->Subject = 'Thank You for Joining Our Community!';
             $mail->Body = "<html>
    <body>

        <p style='text-transform: capitalize'><b>Dear $uname,</b></p>
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
    </html>";
            if ($mail->send()) {
                header('Location: poster.php?name=' . urlencode($uname) . "&designation=" . urlencode($designation) . "&company=" . urlencode($company) . "&img_des=" . urlencode($img_des));
                exit();
            } else {
                $_SESSION['status'] = 'Message could not be sent. Mailer Error: {$mail->ErrorInfo}';
                header("Location: {$_SERVER["HTTP_REFERER"]}");
                exit();
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    else {
        echo "<script>alert('unsuccessful');</script>";
    }

}


// Ensure required parameters are set
if (isset($_GET['name']) && isset($_GET['designation']) &&  isset($_GET['company']) && isset($_GET['img_des'])) {
    $name = htmlspecialchars($_GET['name']);
    $designation = htmlspecialchars($_GET['designation']);
    $company = htmlspecialchars($_GET['company']);
    $img_des = htmlspecialchars($_GET['img_des']);
} else {
    die("Can't submit the form");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Excellence Award Poster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            color: white;
            font-family: 'Arial', sans-serif;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
             background: url(assets/images/Purple\ &\ \ white\ business\ profile\ presentation.png);
        }
        .container{
    display: grid;
    grid-template-areas: 
    'poster-container thanknote';
    width: 100%;
    height: 100%;
    grid-template-columns: 800px 400px;  
        }
        .poster-container {
            padding: 20px;
            background-color: #2c004a; /* Background color */
            background: url('assets/images/bggposter.jpeg');
            background-size: cover; /* Ensure the image covers the entire container */
            background-position: center; /* Center the image */
            background-blend-mode: overlay; /* Blend the background color and image */
            width: 100%;
            max-width: 800px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin-top: 130px;
        
            position: relative; /* Allow positioning of children */
            
        }
        .left-section, .right-section {
            flex: 1;
        }
        .left-section {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative; /* Allow positioning of website-info */
        }
        .profile-img-container {
    
            border-radius: 50%;
            overflow: hidden;
            width: 250px;
            height: 250px;
            margin-right: 78px;
            margin-bottom: 13px;
        }
        .profile-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        
        }
        .right-section {
            text-align: left;
        }
        .company-logo {
            text-align: right;
        }
        .company-logo img {
            max-width: 55%;
            height: auto;
            margin-bottom: 20px;
            margin-right: 90px;
        }
        .name {
            font-size: 28px;
            font-family: Georgia, serif;
            color: #fff;
            text-transform: capitalize;
            margin-top: 20px;
        }
        .designation {
            font-size: 24px;
            color: white;
            margin-bottom: 20px;
            text-transform: capitalize;
            font-family: "Trebuchet MS", Helvetica, sans-serif;
        }
        .award {
            font-size: 2em;
            color: #ffa500;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .date-location {
            font-size: 1.2em;
            color: #d3d3d3;
            margin-top: 10px;
        }
        .title {
    text-transform: capitalize;
    font-size: 45px;
    font-weight: 500;
    margin: 0 auto;
    text-align: center;
    color: #ffa500;
    margin-top: 30px;
    font-family: 'Brush Script MT', cursive;
    position: relative;
}

.title::after {
    content: '';
    display: block;
    width: 40%; /* Adjust width */
    height: 0.6px; /* Adjust height to make it very thin */
    background-color: lightgray; /* Match the color */
    margin: 2px auto 0; /* Adjust spacing */
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
}

        .join-us-title {
            font-weight: 500;
            font-size: 15px;
            color: white;
            margin-top: 45px;
        }
        .social-icons {
            float: right;
            margin-top: 15px;
        }
        .social-icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }
        .website-info {
            position: absolute;
            top: 330px; /* Adjust as needed */
            left: 10px; /* Adjust as needed */
            display: flex;
            align-items: center;
            padding: 5px;
            border-radius: 5px;
        
        }
        .website-icon {
            width: 26px; /* Adjust size as needed */
            height: 20px; /* Adjust size as needed */
            margin-right: 8px; /* Space between icon and name */
        }
        .website-name {
            font-size: 15px; /* Adjust size as needed */
            color: white; /* Adjust color as needed */
        }
        .thanknote{
            font-size: 20px;
            padding: 20px;
            width: 600px;
            position: relative;
            top: 200px;
        }

        @media only screen and (max-width: 600px){
          .container{
            margin-top: 70px;
          }
        
          
            .thanknote{
                position: relative;
                top: 600px;
                right: 700px;
                font-size: 30px;
            }
            #download-button{
                width: 230px;
                height: 60px;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-left: 150px;
            }
            
             body {
            color: white;
            font-family: 'Arial', sans-serif;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            background: url(assets/images/Purple.png);
            
    }
            
   
    }

       
    </style>
</head>
<body>
    <div class="container">
    <div class="poster-container">
        <div class="left-section">
            <div class="profile-img-container">
                <img src="<?php echo $img_des; ?>" alt="Profile Image">
            </div>
            <!-- Add Website Info Section -->
            <div class="website-info">
                <img src="assets/images/web-removebg-preview.png" alt="Website Icon" alt="Website Icon" class="website-icon">
                <span class="website-name">www.vanakkamhrd.com</span>
            </div>
        </div>
        <div class="right-section">
            <div class="company-logo">
                <img src="assets/images/whitelogo.png" alt="Vanakkam HRD Logo">
            </div>
            <h2 class="title text-center">Proud member of</h2>
            <div class="name text-center"><?php echo $name; ?></div>
            <div class="designation text-center"><?php echo $designation; ?><br><?php echo $company; ?></div>
            <div class="date-location">
                <!-- Social Icons -->
                <div class="social-icons">
                    <h3 class="join-us-title text-center">Follow Us!</h3>
                    <img src="assets/images/w1-removebg-preview.png" alt="Facebook Icon" class="social-icon">
                    <img src="assets/images/w2-removebg-preview.png" alt="Instagram Icon" class="social-icon">
                    <img src="assets/images/w3-removebg-preview.png" alt="LinkedIn Icon" class="social-icon">
                    <img src="assets/images/w5-removebg-preview.png" alt="Youtube Icon" class="social-icon">
                </div>
            </div>
        </div>
    </div>

    <!-- Centered download button -->
    
        <!-- This part will not be downloaded -->
        <div class="thanknote text-center text-black mt-4 pt-5">
            <p>"Thank you for joining our community! By becoming a member, you're now part of a vibrant and supportive network. We’re excited for you to experience all the benefits and opportunities our community offers."</p>
            <div class="download-area" style="padding: 20px; cursor: pointer;">
                <a id="download-button" class="btn btn-primary" style="pointer-events: none;">Download Poster</a>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.download-area').addEventListener('click', function(event) {
                event.preventDefault();
                html2canvas(document.querySelector('.poster-container')).then(function(canvas) {
                    var imgData = canvas.toDataURL('image/png');

                    // Create a link and click it to trigger the download
                    var link = document.createElement('a');
                    link.href = imgData;
                    link.download = 'poster.png';
                    link.click();

                    // Upload the image to the server
                    uploadImage(imgData);
                });
            });

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>