<?php
include("../includes/db_connect.php");
include("../includes/mail_function.php");

if (isset($_GET['ids'])) {
    $ids = explode(",", $_GET['ids']);
    
    foreach ($ids as $id) {
        $query = "SELECT name, email FROM event_registration_bengaluru_list WHERE id = '$id'";
        $res = $conn->query($query);
        $user = $res->fetch_assoc();

        $name = $user['name'];
        $email = $user['email'];
        $subject = "Registration not accepted for HR Conference 2025 ( Bengaluru )";
        $message = "
        <html>
                <body>
                <p style='text-transform: capitalize'><b>Dear " . htmlspecialchars($name) . ",</b></p>
                <p>Hope you're doing great! Just wanted to drop you a quick note about your registration for Vanakkam HRD Event HR Conference 2025.</p>
                <p>Unfortunately, it looks like we had to decline it this time around due to limited capacity and high demand.😔</p>
               
                
                    <p>But don't worry, we're always throwing fun mixers and events that you can be a part of in the future. We'd love to have you join us at one of those! </p>
                    <p>If you have any questions or concerns, feel free to reach out. We're here to help.</p>
                    <p><b>Stay connected and talk soon! 🙌</b></p>



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

        if (send_email($email, $subject, $message)) {
            $update_query = "UPDATE event_registration_bengaluru_list SET email_sent = 2 WHERE id = '$id'";
            $conn->query($update_query);
        }
    }

    header("Location: hr_conference_bengaluru_list.php?success=rejected");
    exit();
} else {
    echo "No user selected.";
}
?>
