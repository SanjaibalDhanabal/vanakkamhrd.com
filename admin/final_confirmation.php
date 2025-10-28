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
        $subject = "Remainder!! | Registration Confirmed | Let's Meet at Vanakkam HRD Conference Event at Bengaluru!";
        $message = "
        <html>
                <body>
                <p style='text-transform: capitalize'><b>Dear " . htmlspecialchars($name) . ",</b></p>
                <p>I am elated to confirm your registration for Vanakkam HRD, <b>HR Conference 2025, on 22 February, 2025 at Hotel Grand Mercure, Near Gopalan Mall, Bengaluru.</b></p>
                <p>Here are all the details you'll need:</p>
                <p><b>Agenda for the event:</b><br>
                    09:30 AM - Enroll at Reception to Verify Registration<br>
                    10:00 AM -  Welcome Address<br>
                    10:15 AM - Keynote Speaker<br>
                    11:00 AM - Panel Discussion<br>
                    12:10 PM - Fire Side Chat<br>
                    12:50 PM - Panel Discussion<br>
                    01:50 PM - Vote of Thanks<br>
                    02:00 PM - Networking Lunch
                    </p>
                    
                    <p><b>Click the below image to reach Venue Location:</b></p>
        

        <p>https://maps.app.goo.gl/YZvhuMvfz8CBioUY7</p>
        
    <a href='https://maps.app.goo.gl/YZvhuMvfz8CBioUY7' target='_blank'>
        <img src='https://vanakkamhrd.com/assets/images/map.jpeg' alt='Event Location' width='400' height='300' style='border:0;'>
    </a>
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

        if (send_email($email, $subject, $message)) {
            $update_query = "UPDATE event_registration_bengaluru_list SET email_sent = 1 WHERE id = '$id'";
            $conn->query($update_query);
        }
    }

    header("Location: hr_conference_bengaluru_list.php?success=confirmed");
    exit();
} else {
    echo "No user selected.";
}
?>
